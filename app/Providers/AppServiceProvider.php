<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\ProductRepository;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, function ($app) {
            return new CustomerRepository(new Customer());
        });

        $this->app->bind(OrderRepository::class, function ($app) {
            return new OrderRepository(new Order());
        });

        $this->app->bind(OrderDetailRepository::class, function ($app) {
            return new OrderDetailRepository(new OrderDetail());
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository(new Product());
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
