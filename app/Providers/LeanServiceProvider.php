<?php

namespace App\Providers;

use App\Lean\Pages;
use App\Lean\Pages\Statistics;
use App\Lean\Resources;
use Illuminate\Support\ServiceProvider;
use Lean\Lean;
use Lean\Livewire\Pages\Welcome;

class LeanServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Lean::$name = 'My Store';

        Lean::addPage('home', Welcome::class);
        Lean::addPage('statistics', Statistics::class);

        Lean::addResource('orders', Resources\OrderResource::class);
        Lean::addResource('products', Resources\ProductResource::class);
        Lean::addResource('customers', Resources\CustomerResource::class);
        Lean::addResource('order-products', Resources\OrderProductResource::class);

        Lean::addResource('users', Resources\UserResource::class);
    }
}
