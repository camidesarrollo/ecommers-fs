<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Repositories\CategoryRepository;
use App\Domain\RepositoriesInterface\CategoryRepositoryInterface;
use App\Domain\RepositoriesInterface\ProductRepositoryInterface;
use App\Domain\RepositoriesInterface\ProductVariantPriceHistoryRepositoryInterface;
use App\Domain\RepositoriesInterface\OrderItemRepositoryInterface;
use App\Infrastructure\Repositories\ProductRepository;
use App\Infrastructure\Repositories\ProductVariantPriceHistoryRepository;
use App\Infrastructure\Repositories\OrderItemRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
