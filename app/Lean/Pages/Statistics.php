<?php

namespace App\Lean\Pages;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Lean\LeanPage;
use Lean\Livewire\Actions\WithNotifications;

/**
 * @property-read Collection $orders
 */
class Statistics extends LeanPage
{
    use WithNotifications;

    public static function icon(): string
    {
        return 'heroicon-o-chart-bar';
    }

    public function generate()
    {
        $customer = Customer::cursor()->random();
        $product = Product::cursor()->random();
        $quantity = rand(1, 5);

        $customer->orders()->create()->products()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $this->notify("{$customer->name} has purchased {$quantity}x {$product->name}");
    }

    public function fetch()
    {
        $this->notify("Fetched data from server.");
    }

    public function render()
    {
        return view('lean.pages.statistics', [
            'orders' => Order::with('customer', 'products')->get(),
        ]);
    }
}
