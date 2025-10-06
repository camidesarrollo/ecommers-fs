<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Http\Repositories\CategoryRepository;
use App\Domain\RepositoriesInterface\CategoryRepositoryInterface;
use App\Domain\RepositoriesInterface\ProductRepositoryInterface;
use App\Domain\RepositoriesInterface\ProductVariantPriceHistoryRepositoryInterface;
use App\Domain\RepositoriesInterface\OrderItemRepositoryInterface;
use App\Domain\RepositoriesInterface\UserRepositoryInterface;
use App\Domain\RepositoriesInterface\EmailPreferenceRepositoryInterface;
use App\Infrastructure\Http\Repositories\ProductRepository;
use App\Infrastructure\Http\Repositories\ProductVariantPriceHistoryRepository;
use App\Infrastructure\Http\Repositories\OrderItemRepository;
use App\Infrastructure\Http\Repositories\UserRepository;
use App\Infrastructure\Http\Repositories\EmailPreferenceRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductVariantPriceHistoryRepositoryInterface::class, ProductVariantPriceHistoryRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(EmailPreferenceRepositoryInterface::class, EmailPreferenceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
