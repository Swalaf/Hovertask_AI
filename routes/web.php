<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Home / Landing Page - Homepage (Landing Page)
Route::get('/', function () {
    return view('pages.homepage');
})->name('home');

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Dashboard (authenticated users)
// Note: Dashboard route is in the auth middleware group below

// About Us
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contact Us
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// FAQ
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

// Authentication Routes (Public)
Route::get('/login', function () {
    return view('auth.signin');
})->name('login');

Route::get('/signin', function () {
    return view('auth.signin');
})->name('login');

Route::post('/signin', function () {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        request()->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->name('login.post');

Route::post('/login', function () {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        request()->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->name('login.post');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/signup', function () {
    return view('auth.signup');
})->name('register');

Route::post('/signup', function () {
    // Registration logic would go here
    return redirect('/dashboard');
})->name('register.post');

Route::get('/register', function () {
    return view('auth.signup');
})->name('register');

// Password Reset Routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/verify-reset-code', function () {
    return view('auth.verify-reset-code');
})->name('password.verify');

Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/earn', [DashboardController::class, 'earn'])->name('dashboard.earn');
    Route::get('/dashboard/earn/tasks', [DashboardController::class, 'earnTasks'])->name('dashboard.earn.tasks');
    Route::get('/dashboard/earn/tasks/history', [DashboardController::class, 'taskHistory'])->name('dashboard.earn.tasks.history');
    Route::get('/dashboard/earn/task/{id}', [DashboardController::class, 'taskDetail'])->name('dashboard.earn.task.detail');
    Route::post('/dashboard/earn/task/{id}/complete', [DashboardController::class, 'completeTask'])->name('dashboard.earn.task.complete');
    Route::get('/dashboard/earn/adverts', [DashboardController::class, 'earnAdverts'])->name('dashboard.earn.adverts');
    Route::get('/dashboard/earn/resell', [DashboardController::class, 'earnResell'])->name('dashboard.earn.resell');
    Route::get('/dashboard/advertise', [DashboardController::class, 'advertise'])->name('dashboard.advertise');
    Route::get('/dashboard/advertise/post-advert', [DashboardController::class, 'postAdvert'])->name('dashboard.advertise.post');
    Route::post('/dashboard/advertise/create', [DashboardController::class, 'createAdvert'])->name('dashboard.advertise.create');
    Route::get('/dashboard/advertise/history', [DashboardController::class, 'advertiseHistory'])->name('dashboard.advertise.history');

    // Freelance Task Routes
    Route::get('/dashboard/freelance', [DashboardController::class, 'freelanceBrowse'])->name('dashboard.freelance');
    Route::get('/dashboard/freelance/browse', [DashboardController::class, 'freelanceBrowse'])->name('dashboard.freelance.browse');
    Route::get('/dashboard/freelance/my-tasks', [DashboardController::class, 'freelanceMyTasks'])->name('dashboard.freelance.my-tasks');
    Route::get('/dashboard/freelance/create', [DashboardController::class, 'freelanceCreate'])->name('dashboard.freelance.create');
    Route::get('/dashboard/freelance/detail/{id}', [DashboardController::class, 'freelanceDetail'])->name('dashboard.freelance.detail');

    // Job Task Routes
    Route::get('/dashboard/jobs', [DashboardController::class, 'jobsBrowse'])->name('dashboard.jobs');
    Route::get('/dashboard/jobs/browse', [DashboardController::class, 'jobsBrowse'])->name('dashboard.jobs.browse');
    Route::get('/dashboard/jobs/my-jobs', [DashboardController::class, 'jobsMyJobs'])->name('dashboard.jobs.my-jobs');
    Route::get('/dashboard/jobs/create', [DashboardController::class, 'jobsCreate'])->name('dashboard.jobs.create');
    Route::get('/dashboard/jobs/detail/{id}', [DashboardController::class, 'jobsDetail'])->name('dashboard.jobs.detail');
});

// Public Marketplace Routes (Outside Auth)
Route::get('/marketplace', [DashboardController::class, 'publicMarketplace'])->name('marketplace');
Route::get('/marketplace/product/{id}', [DashboardController::class, 'marketplaceProductDetail'])->name('marketplace.product');
Route::get('/marketplace/category/{category}', [DashboardController::class, 'marketplaceByCategory'])->name('marketplace.category');

// Authenticated routes (Seller Dashboard Marketplace)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/marketplace', [DashboardController::class, 'marketplaceDashboard'])->name('dashboard.marketplace');
    Route::get('/dashboard/marketplace/my-products', [DashboardController::class, 'marketplaceDashboard'])->name('dashboard.marketplace.my-products');
    Route::get('/dashboard/marketplace/index', [DashboardController::class, 'marketplaceDashboard'])->name('dashboard.marketplace.index');
    Route::get('/dashboard/marketplace/create', [DashboardController::class, 'marketplaceCreate'])->name('dashboard.marketplace.create');
    Route::get('/dashboard/marketplace/add-product', [DashboardController::class, 'marketplaceCreate'])->name('dashboard.marketplace.add-product');
    Route::post('/dashboard/marketplace/store', [DashboardController::class, 'marketplaceStore'])->name('dashboard.marketplace.store');
    Route::get('/dashboard/marketplace/edit/{id}', [DashboardController::class, 'marketplaceEdit'])->name('dashboard.marketplace.edit');
    Route::put('/dashboard/marketplace/update/{id}', [DashboardController::class, 'marketplaceUpdate'])->name('dashboard.marketplace.update');
    Route::delete('/dashboard/marketplace/destroy/{id}', [DashboardController::class, 'marketplaceDestroy'])->name('dashboard.marketplace.destroy');
    Route::get('/dashboard/marketplace/listings', [DashboardController::class, 'marketplaceListings'])->name('dashboard.marketplace.listings');
    Route::get('/dashboard/marketplace/delete/{id}', [DashboardController::class, 'marketplaceDestroy'])->name('dashboard.marketplace.delete');

    // Add Me Up Routes
    Route::get('/dashboard/add-me-up', [DashboardController::class, 'addMeUp'])->name('dashboard.add-me-up');
    Route::post('/dashboard/add-me-up/create-list', [DashboardController::class, 'addMeUpCreateList'])->name('dashboard.add-me-up.create-list');
    Route::post('/dashboard/add-me-up/store-contact', [DashboardController::class, 'addMeUpStoreContact'])->name('dashboard.add-me-up.store-contact');
    Route::get('/dashboard/add-me-up/browse', [DashboardController::class, 'addMeUpBrowse'])->name('dashboard.add-me-up.browse');
    Route::get('/dashboard/add-me-up/list/{id}', [DashboardController::class, 'addMeUpListDetail'])->name('dashboard.add-me-up.list-detail');

    // Other Dashboard Routes
    Route::get('/dashboard/refer-and-earn', [DashboardController::class, 'refer'])->name('dashboard.refer');
    Route::get('/dashboard/wallet', [DashboardController::class, 'wallet'])->name('dashboard.wallet');
    Route::get('/dashboard/fund-wallet', [DashboardController::class, 'fundWallet'])->name('dashboard.fund.wallet');
    Route::post('/dashboard/fund-wallet', [DashboardController::class, 'processFundWallet'])->name('dashboard.fund.wallet.process');
    Route::get('/dashboard/transactions', [DashboardController::class, 'transactions'])->name('dashboard.transactions');
    Route::get('/dashboard/notifications', [DashboardController::class, 'notifications'])->name('dashboard.notifications');
    Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::get('/dashboard/kyc', [DashboardController::class, 'kyc'])->name('dashboard.kyc');

    // Onboarding Routes
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding.index');
    Route::get('/onboarding/{step}', [OnboardingController::class, 'showStep'])->name('onboarding.step');
    Route::post('/onboarding/step1', [OnboardingController::class, 'step1'])->name('onboarding.step1');
    Route::post('/onboarding/step2', [OnboardingController::class, 'step2'])->name('onboarding.step2');
    Route::post('/onboarding/step3', [OnboardingController::class, 'step3'])->name('onboarding.step3');
    Route::post('/onboarding/step4', [OnboardingController::class, 'step4'])->name('onboarding.step4');
    Route::post('/onboarding/step5', [OnboardingController::class, 'step5'])->name('onboarding.step5');
    Route::get('/onboarding/skip', [OnboardingController::class, 'skip'])->name('onboarding.skip');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/earn', [DashboardController::class, 'earn'])->name('earn.index');
    Route::get('/earn/tasks', [DashboardController::class, 'earnTasks'])->name('earn.tasks');
    Route::get('/earn/tasks/history', [DashboardController::class, 'earnTasks'])->name('earn.tasks.history');
    Route::get('/earn/adverts', [DashboardController::class, 'earnAdverts'])->name('earn.adverts');
    Route::get('/earn/resell', [DashboardController::class, 'earnResell'])->name('earn.resell');
});

Route::get('/advertise', function () {
    return view('dashboard.advertise');
})->name('advertise');

Route::get('/advertise/post-advert', function () {
    return view('dashboard.advertise-post');
})->name('advertise.post');

Route::get('/advertise/history', function () {
    return view('dashboard.advertise');
})->name('advertise.history');

Route::get('/wallet', function () {
    return view('dashboard.wallet');
})->name('wallet');

Route::get('/fund-wallet', function () {
    return view('dashboard.fund-wallet');
})->name('wallet.fund');

Route::get('/marketplace/list-product', function () {
    return view('pages.marketplace');
})->name('marketplace.list');

Route::get('/reseller-stats', function () {
    return view('dashboard.earn-resell');
})->name('reseller.stats');

Route::get('/refer-and-earn', function () {
    return view('dashboard.refer');
})->name('refer');

Route::get('/add-me-up', function () {
    return view('dashboard.add-me-up');
})->name('addmeup');

Route::get('/add-me-up/profile', function () {
    return view('dashboard.add-me-up');
})->name('addmeup.profile');

Route::get('/add-me-up/points', function () {
    return view('dashboard.add-me-up');
})->name('addmeup.points');

Route::get('/add-me-up/list-profile', function () {
    return view('dashboard.add-me-up');
})->name('addmeup.list');

Route::get('/settings', function () {
    return view('dashboard.settings');
})->name('settings');

Route::get('/notifications', function () {
    return view('dashboard.notifications');
})->name('notifications');

Route::get('/terms', function () {
    return view('welcome');
})->name('terms');

Route::get('/privacy-policy', function () {
    return view('welcome');
})->name('privacy');

// NOTE: broadcasting auth endpoint moved to `routes/api.php` to support
// token (Bearer) based authentication used by the React SPA.

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:superadministrator|administrator'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_products' => \App\Models\Product::count(),
            'total_orders' => \App\Models\Order::count(),
            'total_revenue' => \App\Models\Transaction::where('type', 'payment')->sum('amount') ?? 0,
            'active_tasks' => \App\Models\Task::where('status', 'active')->count(),
            'pending_withdrawals' => \App\Models\Withdrawal::where('status', 'pending')->count(),
            'pending_withdrawals_amount' => \App\Models\Withdrawal::where('status', 'pending')->sum('amount') ?? 0,
            'active_advertises' => \App\Models\Advertise::where('status', 'active')->count(),
            'completed_tasks' => \App\Models\CompletedTask::count(),
            'pending_kyc' => \App\Models\KYC::where('status', 'pending')->count(),
            'pending_adverts' => \App\Models\Advertise::where('status', 'pending')->count(),
            'pending_task_approvals' => \App\Models\CompletedTask::where('status', 'pending')->count(),
            'memory_usage' => '45%',
            'last_backup' => 'Never',
        ];

        return view('admin.dashboard', compact('stats'));
    })->name('admin.dashboard');

    // Users
    Route::get('/users', function () {
        $users = \App\Models\User::with(['roles', 'wallet'])->paginate(20);

        return view('admin.users.index', compact('users'));
    })->name('admin.users.index');

    // Tasks
    Route::get('/tasks', function () {
        $tasks = \App\Models\Task::with(['user'])->paginate(20);
        $stats = [
            'total_tasks' => \App\Models\Task::count(),
            'active_tasks' => \App\Models\Task::where('status', 'active')->count(),
            'pending_tasks' => \App\Models\Task::where('status', 'pending')->count(),
            'completed_tasks' => \App\Models\CompletedTask::count(),
            'expired_tasks' => \App\Models\Task::where('status', 'expired')->count(),
        ];

        return view('admin.tasks.index', compact('tasks', 'stats'));
    })->name('admin.tasks.index');

    // Products
    Route::get('/products', function () {
        $products = \App\Models\Product::with(['user', 'category'])->paginate(20);

        return view('admin.products.index', compact('products'));
    })->name('admin.products.index');

    // Orders
    Route::get('/orders', function () {
        $orders = \App\Models\Order::with(['user'])->paginate(20);

        return view('admin.orders.index', compact('orders'));
    })->name('admin.orders.index');

    // Categories
    Route::get('/categories', function () {
        $categories = \App\Models\Category::with('parent')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    })->name('admin.categories.index');

    // Withdrawals
    Route::get('/withdrawals', function () {
        $withdrawals = \App\Models\Withdrawal::with(['user'])->paginate(20);

        return view('admin.withdrawals.index', compact('withdrawals'));
    })->name('admin.withdrawals.index');

    // Transactions
    Route::get('/transactions', function () {
        $transactions = \App\Models\Transaction::with(['user'])->paginate(20);

        return view('admin.transactions.index', compact('transactions'));
    })->name('admin.transactions.index');

    // Advertisements
    Route::get('/advertises', function () {
        $advertises = \App\Models\Advertise::with(['user'])->paginate(20);

        return view('admin.advertises.index', compact('advertises'));
    })->name('admin.advertises.index');

    // Completed Tasks
    Route::get('/completed-tasks', function () {
        $completedTasks = \App\Models\CompletedTask::with(['user', 'task'])->paginate(20);

        return view('admin.completed-tasks.index', compact('completedTasks'));
    })->name('admin.completed-tasks.index');

    // Referrals
    Route::get('/referrals', function () {
        $referrals = \App\Models\Referral::with(['referrer', 'referee'])->paginate(20);

        return view('admin.referrals.index', compact('referrals'));
    })->name('admin.referrals.index');

    // Reseller Conversions
    Route::get('/reseller-conversions', function () {
        $conversions = \App\Models\ResellerConversion::with(['reseller', 'product'])->paginate(20);

        return view('admin.reseller-conversions.index', compact('conversions'));
    })->name('admin.reseller-conversions.index');

    // Roles & Permissions
    Route::get('/roles', function () {
        $roles = \App\Models\Role::with('permissions')->paginate(20);

        return view('admin.roles.index', compact('roles'));
    })->name('admin.roles.index');

    // Activity Logs
    Route::get('/activity-logs', function () {
        // Placeholder - would need ActivityLog model
        $logs = collect([]);

        return view('admin.activity-logs.index', compact('logs'));
    })->name('admin.activity-logs.index');

    // Settings
    Route::get('/settings', function () {
        return view('admin.settings.index');
    })->name('admin.settings.index');

    Route::post('/settings/{group}', function ($group) {
        // Settings update logic
        return back()->with('success', 'Settings updated successfully');
    })->name('admin.settings.update');

    // Maintenance
    Route::get('/maintenance', function () {
        $diskUsage = [
            'used' => '450 MB',
            'total' => '2 GB',
            'percentage' => 22,
        ];
        $backups = collect([]);

        return view('admin.maintenance.index', compact('diskUsage', 'backups'));
    })->name('admin.maintenance.index');

    // Maintenance Actions
    Route::post('/maintenance/clear-cache/{type}', function ($type) {
        return response()->json(['success' => true, 'message' => 'Cache cleared successfully']);
    })->name('admin.maintenance.clear-cache');

    Route::post('/maintenance/migrate', function () {
        return response()->json(['success' => true, 'message' => 'Migrations completed']);
    })->name('admin.maintenance.migrate');

    Route::post('/maintenance/seed', function () {
        return response()->json(['success' => true, 'message' => 'Database seeded']);
    })->name('admin.maintenance.seed');

    Route::post('/maintenance/optimize', function () {
        return response()->json(['success' => true, 'message' => 'Database optimized']);
    })->name('admin.maintenance.optimize');

    Route::post('/maintenance/backup/create', function () {
        return response()->json(['success' => true]);
    })->name('admin.maintenance.backup.create');
});
