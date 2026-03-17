<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\CompletedTask;
use App\Models\Contact;
use App\Models\ContactList;
use App\Models\Order;
use App\Models\Product;
use App\Models\ResellerLink;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Main Dashboard Index
     */
    public function index()
    {
        $user = auth()->user();

        // Check if user needs to complete onboarding
        if ($user->onboarding_status !== 'completed') {
            return redirect()->route('onboarding.index');
        }

        $wallet = Wallet::where('user_id', $user->id)->first();
        $tasks = Task::where('user_id', $user->id)->get();
        $completedTasks = CompletedTask::where('user_id', $user->id)->get();
        $orders = Order::where('user_id', $user->id)->get();
        $resellers = ResellerLink::where('user_id', $user->id)->get();
        $products = Product::where('user_id', $user->id)->get();
        $advertises = Advertise::where('user_id', $user->id)->get();

        $totalCompletedTasks = $completedTasks->count();
        $totalOrders = $orders->count();
        $totalResellers = $resellers->count();
        $totalProducts = $products->count();
        $totalAdvertises = $advertises->count();

        // Recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'wallet',
            'tasks',
            'completedTasks',
            'totalCompletedTasks',
            'totalOrders',
            'totalResellers',
            'totalProducts',
            'totalAdvertises',
            'recentTransactions'
        ));
    }

    /**
     * Earn Section - Tasks
     */
    public function earn()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->get();
        $completedTasks = CompletedTask::where('user_id', $user->id)->get();

        return view('dashboard.earn', compact('tasks', 'completedTasks'));
    }

    /**
     * Earn Tasks List
     */
    public function earnTasks()
    {
        // Get available social/engagement tasks for users to complete
        $availableTasks = Task::where('status', 'active')
            ->where('task_category', 'engagement')
            ->where('task_count_remaining', '>', 0)
            ->latest()
            ->paginate(20);

        // Get user's completed tasks
        $completedTasks = CompletedTask::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard.earn-tasks', compact('availableTasks', 'completedTasks'));
    }

    /**
     * Task Detail Page
     */
    public function taskDetail($id)
    {
        $task = Task::findOrFail($id);

        return view('dashboard.task-detail', compact('task'));
    }

    /**
     * Complete Task
     */
    public function completeTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();

        // Check if task still has available slots
        if ($task->task_count_remaining <= 0) {
            return back()->with('error', 'This task is fully completed');
        }

        // Check if user already completed this task
        $existingCompletion = CompletedTask::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingCompletion) {
            return back()->with('error', 'You have already completed this task');
        }

        // Create completed task record
        CompletedTask::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'status' => 'completed',
            'payment_status' => 'pending',
            'amount' => $task->payment_per_task,
        ]);

        // Decrement remaining task count
        $task->decrement('task_count_remaining');

        return back()->with('success', 'Task completed successfully! Your reward is pending verification.');
    }

    /**
     * Earn Adverts List
     */
    public function earnAdverts()
    {
        $user = auth()->user();
        $advertises = Advertise::where('user_id', $user->id)->get();

        return view('dashboard.earn-adverts', compact('advertises'));
    }

    /**
     * Earn Resell
     */
    public function earnResell()
    {
        $user = auth()->user();
        $resellers = ResellerLink::where('user_id', $user->id)->get();
        $products = Product::where('status', 'active')
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('dashboard.earn-resell', compact('resellers', 'products'));
    }

    /**
     * Task History - View completed tasks
     */
    public function taskHistory()
    {
        $user = auth()->user();

        // Get user's completed tasks
        $completedTasks = CompletedTask::where('user_id', $user->id)
            ->with('task')
            ->latest()
            ->paginate(20);

        return view('dashboard.tasks-history', compact('completedTasks'));
    }

    /**
     * Advertise History - View all advert campaigns
     */
    public function advertiseHistory()
    {
        $user = auth()->user();

        // Get all adverts for this user
        $adverts = Advertise::where('user_id', $user->id)
            ->with(['completedTasks', 'task'])
            ->latest()
            ->paginate(20);

        return view('dashboard.advertise-history', compact('adverts'));
    }

    /**
     * Advertise Section
     */
    public function advertise()
    {
        $user = auth()->user();
        $advertises = Advertise::where('user_id', $user->id)->get();

        return view('dashboard.advertise', compact('advertises'));
    }

    /**
     * Post Advert
     */
    public function postAdvert()
    {
        return view('dashboard.advertise-post');
    }

    /**
     * Create Advert (Web Route - Session Auth)
     */
    public function createAdvert(Request $request)
    {
        // Resolve the API controller from the service container so its dependencies
        // (repositories, etc.) are injected correctly instead of trying to 'new' them
        // with an incorrect namespace which caused failures when posting adverts.
        $advertiseController = app(\App\Http\Controllers\Api\V1\AdvertiseController::class);

        // Forward the current request to the API controller method and return its response
        return $advertiseController->create($request);
    }

    /**
     * Marketplace - User's Products (Seller Dashboard)
     */
    public function marketplace()
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('dashboard.marketplace', compact('products'));
    }

    /**
     * Public Marketplace (for guests - no contact details)
     */
    public function publicMarketplace()
    {
        $products = Product::where('status', 'active')
            ->with('user')
            ->latest()
            ->paginate(20);

        $isLoggedIn = auth()->check();

        return view('pages.marketplace', compact('products', 'isLoggedIn'));
    }

    /**
     * Add Me Up - Main Dashboard
     */
    public function addMeUp()
    {
        $user = auth()->user();

        // Get user's contact lists
        $contactLists = ContactList::where('user_id', $user->id)
            ->withCount('contacts')
            ->latest()
            ->get();

        // Get user's contacts
        $contacts = Contact::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        // Get public contact lists (for browsing)
        $publicLists = ContactList::where('is_public', true)
            ->withCount('contacts')
            ->latest()
            ->get();

        // Calculate points earned from contacts
        $totalContacts = Contact::where('user_id', $user->id)->count();
        $publicContacts = Contact::where('is_public', true)->count();

        return view('dashboard.add-me-up', compact(
            'user',
            'contactLists',
            'contacts',
            'publicLists',
            'totalContacts',
            'publicContacts'
        ));
    }

    /**
     * Add Me Up - Create New Contact List
     */
    public function addMeUpCreateList(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_public' => 'boolean',
        ]);

        $user = auth()->user();

        $contactList = ContactList::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'is_public' => $request->is_public ?? false,
        ]);

        return redirect()->route('dashboard.add-me-up')->with('success', 'Contact list created successfully!');
    }

    /**
     * Add Me Up - Add Contact to List
     */
    public function addMeUpStoreContact(Request $request)
    {
        $request->validate([
            'contact_list_id' => 'required|exists:contact_lists,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'is_public' => 'boolean',
        ]);

        $user = auth()->user();

        // Verify the list belongs to the user
        $contactList = ContactList::where('id', $request->contact_list_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        Contact::create([
            'user_id' => $user->id,
            'contact_list_id' => $request->contact_list_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_public' => $request->is_public ?? false,
        ]);

        return redirect()->route('dashboard.add-me-up')->with('success', 'Contact added successfully!');
    }

    /**
     * Add Me Up - Browse Public Contacts
     */
    public function addMeUpBrowse()
    {
        $publicLists = ContactList::where('is_public', true)
            ->withCount('contacts')
            ->latest()
            ->paginate(20);

        return view('dashboard.add-me-up-browse', compact('publicLists'));
    }

    /**
     * Add Me Up - View Contact List Details
     */
    public function addMeUpListDetail($id)
    {
        $contactList = ContactList::with(['contacts', 'user'])
            ->where(function ($query) use ($id) {
                $query->where('id', $id)
                    ->where(function ($q) {
                        $q->where('is_public', true)
                            ->orWhere('user_id', auth()->id());
                    });
            })
            ->firstOrFail();

        return view('dashboard.add-me-up-detail', compact('contactList'));
    }

    /**
     * Refer and Earn
     */
    public function refer()
    {
        $user = auth()->user();
        $referrals = User::where('referred_by', $user->id)->get();

        return view('dashboard.refer', compact('referrals'));
    }

    /**
     * Wallet
     */
    public function wallet()
    {
        $user = auth()->user();
        $wallet = Wallet::where('user_id', $user->id)->first();
        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('dashboard.wallet', compact('wallet', 'transactions'));
    }

    /**
     * Fund Wallet
     */
    public function fundWallet()
    {
        $prefillAmount = request()->get('amount', '');

        return view('dashboard.fund-wallet', compact('prefillAmount'));
    }

    /**
     * Process Fund Wallet
     */
    public function processFundWallet(Request $request)
    {
        $amount = $request->input('amount');
        $returnTo = $request->input('return_to', '/dashboard/advertise/post-advert');

        if (! $amount || $amount < 100) {
            return back()->with('error', 'Minimum amount is ₦100');
        }

        // Store return URL in session for after payment
        session()->put('fund_wallet_return_url', $returnTo);

        // Get the authenticated user
        $user = auth()->user();

        // Initialize payment via wallet controller
        $walletController = app(\App\Http\Controllers\Api\V1\WalletController::class);
        $paymentRequest = new \Illuminate\Http\Request;
        $paymentRequest->merge(['amount' => $amount]);

        try {
            $response = $walletController->initializePayment($paymentRequest);

            // If response is redirect, follow it
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                return $response;
            }

            // If response is JSON, return with data
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getContent(), true);
                if (isset($data['data']['authorization_url'])) {
                    return redirect($data['data']['authorization_url']);
                }
            }

            return back()->with('error', 'Failed to initialize payment. Please try again.');
        } catch (\Exception $e) {
            \Log::error('Wallet fund error: '.$e->getMessage());

            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Transactions
     */
    public function transactions()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(30);

        return view('dashboard.transactions', compact('transactions'));
    }

    /**
     * Notifications - Using Laravel's notification system
     */
    public function notifications()
    {
        $user = auth()->user();
        // Get notifications via Laravel's notification system
        $notifications = $user->notifications;

        return view('dashboard.notifications', compact('notifications'));
    }

    /**
     * Settings
     */
    public function settings()
    {
        $user = auth()->user();

        return view('dashboard.settings', compact('user'));
    }

    /**
     * KYC Verification
     */
    public function kyc()
    {
        $user = auth()->user();

        return view('dashboard.kyc', compact('user'));
    }

    /**
     * Marketplace - Seller Dashboard
     */
    public function marketplaceDashboard()
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)->latest()->paginate(20);
        $totalSales = \App\Models\OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        $totalRevenue = \App\Models\OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('price');

        return view('dashboard.marketplace', compact('products', 'totalSales', 'totalRevenue'));
    }

    /**
     * Marketplace - Create Listing Form
     */
    public function marketplaceCreate()
    {
        return view('dashboard.marketplace-create');
    }

    /**
     * Marketplace - Store New Listing
     */
    public function marketplaceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        $product = new Product;
        $product->user_id = $user->id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->stock = $request->stock;
        $product->status = 'active';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('dashboard.marketplace')->with('success', 'Product listed successfully!');
    }

    /**
     * Marketplace - Edit Listing Form
     */
    public function marketplaceEdit($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('dashboard.marketplace-edit', compact('product'));
    }

    /**
     * Marketplace - Update Listing
     */
    public function marketplaceUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('dashboard.marketplace')->with('success', 'Product updated successfully!');
    }

    /**
     * Marketplace - Delete Listing
     */
    public function marketplaceDestroy($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('dashboard.marketplace')->with('success', 'Product deleted successfully!');
    }

    /**
     * Marketplace - User's Listings
     */
    public function marketplaceListings()
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard.marketplace-listings', compact('products'));
    }

    /**
     * Public Marketplace - Browse All Products
     */
    public function marketplaceBrowse(Request $request)
    {
        $query = Product::where('status', 'active');

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $products = $query->with('user')->latest()->paginate(20);
        $categories = Product::distinct()->pluck('category')->filter();

        return view('pages.marketplace', compact('products', 'categories'));
    }

    /**
     * Public Marketplace - Product Detail
     */
    public function marketplaceProductDetail($id)
    {
        $product = Product::with('user')->findOrFail($id);

        // Get related products in same category
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Public Marketplace - Browse by Category
     */
    public function marketplaceByCategory($category)
    {
        $products = Product::where('category', $category)
            ->where('status', 'active')
            ->with('user')
            ->latest()
            ->paginate(20);

        $categories = Product::distinct()->pluck('category')->filter();

        return view('pages.marketplace', compact('products', 'categories', 'category'));
    }

    // ============================================
    // FREELANCE TASK MODULE
    // ============================================

    /**
     * Browse Freelance Tasks
     */
    public function freelanceBrowse()
    {
        $freelanceTasks = Task::where('task_category', 'freelance')
            ->where('status', 'active')
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('dashboard.freelance-browse', compact('freelanceTasks'));
    }

    /**
     * My Freelance Tasks
     */
    public function freelanceMyTasks()
    {
        $user = auth()->user();
        $freelanceTasks = Task::where('user_id', $user->id)
            ->where('task_category', 'freelance')
            ->latest()
            ->paginate(20);

        return view('dashboard.freelance-my-tasks', compact('freelanceTasks'));
    }

    /**
     * Create Freelance Task Form
     */
    public function freelanceCreate()
    {
        return view('dashboard.freelance-create');
    }

    /**
     * Freelance Task Detail
     */
    public function freelanceDetail($id)
    {
        $task = Task::with('user')->findOrFail($id);

        return view('dashboard.freelance-detail', compact('task'));
    }

    // ============================================
    // JOB TASK MODULE
    // ============================================

    /**
     * Browse Jobs
     */
    public function jobsBrowse()
    {
        $jobs = Task::where('task_category', 'job')
            ->where('status', 'active')
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('dashboard.jobs-browse', compact('jobs'));
    }

    /**
     * My Posted Jobs
     */
    public function jobsMyJobs()
    {
        $user = auth()->user();
        $jobs = Task::where('user_id', $user->id)
            ->where('task_category', 'job')
            ->latest()
            ->paginate(20);

        return view('dashboard.jobs-my-jobs', compact('jobs'));
    }

    /**
     * Create Job Form
     */
    public function jobsCreate()
    {
        return view('dashboard.jobs-create');
    }

    /**
     * Job Detail
     */
    public function jobsDetail($id)
    {
        $job = Task::with('user')->findOrFail($id);

        return view('dashboard.jobs-detail', compact('job'));
    }
}
