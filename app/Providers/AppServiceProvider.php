<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, function ($app) {
            return new CustomerRepository();
        });

        $this->app->bind(OrderRepository::class, function ($app) {
            return new OrderRepository();
        });

        $this->app->bind(OrderDetailRepository::class, function ($app) {
            return new OrderDetailRepository();
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
