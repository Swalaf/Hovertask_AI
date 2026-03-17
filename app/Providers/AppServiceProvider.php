<?php

namespace App\Providers;

use App\Repositories\AddMeUpRepository;
use App\Repositories\AdvertiseRepository;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ChatRepository;
use App\Repositories\ContactRepository;
use App\Repositories\IAddMeUpRepository;
use App\Repositories\IAdvertiseRepository;
use App\Repositories\ICartRepository;
use App\Repositories\ICategoryRepository;
use App\Repositories\IChatRepository;
use App\Repositories\IContactRepository;
use App\Repositories\IKYCRepository;
use App\Repositories\Interfaces\ISocialConnectRepository;
use App\Repositories\IOrderRepository;
use App\Repositories\IProductRepository;
use App\Repositories\IReviewRepository;
use App\Repositories\ITaskRepository;
use App\Repositories\ITrendingProductRepository;
use App\Repositories\IUserRepository;
use App\Repositories\IWalletRepository;
use App\Repositories\IWishlistRepository;
use App\Repositories\KYCRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TrendingProductRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use App\Repositories\WishlistRepository;
use App\Services\FileUploadService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use SocialConnectRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IWishlistRepository::class, WishlistRepository::class);
        $this->app->bind(ICartRepository::class, CartRepository::class);
        $this->app->bind(IWalletRepository::class, WalletRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(ITrendingProductRepository::class, TrendingProductRepository::class);
        $this->app->bind(ISocialConnectRepository::class, SocialConnectRepository::class);
        $this->app->bind(IContactRepository::class, ContactRepository::class);
        $this->app->bind(IChatRepository::class, ChatRepository::class);
        $this->app->bind(IAddMeUpRepository::class, AddMeUpRepository::class);
        $this->app->bind(IAdvertiseRepository::class, AdvertiseRepository::class);
        $this->app->bind(IKYCRepository::class, KYCRepository::class);

        $this->app->bind(IReviewRepository::class, ReviewRepository::class);
        $this->app->bind(PaymentService::class, function ($app) {
            return new PaymentService;
        });
        $this->app->bind(FileUploadService::class, function ($app) {
            return new FileUploadService;
        });

        // Register Socialite drivers
        $this->app->extend(SocialiteFactory::class, function ($service, $app) {
            $socialite = $service;

            // Register TikTok driver
            $socialite->extend('tiktok', function ($app) use ($socialite) {
                $config = $app['config']['services.tiktok'];

                return $socialite->buildProvider(
                    \SocialiteProviders\TikTok\Provider::class,
                    $config
                );
            });

            return $socialite;
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('tiktok', \SocialiteProviders\TikTok\Provider::class);
        });
    }
}
