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
