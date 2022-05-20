<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Observers\AddressObserver;
use App\Observers\OrderItemObserver;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
    }
}