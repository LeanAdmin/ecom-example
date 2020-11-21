<?php

namespace App\Lean\Actions;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Lean\Livewire\Actions\LeanAction;

class CreateOrderAction extends LeanAction
{
    public Order $order;
    public Collection $availableProducts;
    public array $products = [];

    public $rules = [
        'order.customer_id' => 'required|exists:customers,id',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|numeric|min:1',
    ];

    public function mount()
    {
        $this->order = new Order;
        $this->order->customer_id = $this->customers->first()->id;

        $this->availableProducts = Product::all();

        $this->addProduct();
    }

    public function addProduct()
    {
        $this->products[] = [
            'product_id' => $this->availableProducts->first()->id,
            'quantity' => 1,
        ];
    }

    public function getProductTotal($product)
    {
        return $this->availableProducts->find($product['product_id'])->price * $product['quantity'];
    }

    public function removeProduct(int $id)
    {
        if (array_key_exists($id, $this->products)) {
            unset($this->products[$id]);
        }

        $this->products = array_values($this->products);
    }

    public function submit()
    {
        $this->validate();

        $this->order->save();

        $this->order->products()->createMany($this->products);

        $this->notifyOnNextPage('Order created.');

        return redirect(route('lean.resource.show', ['resource' => 'orders', 'id' => $this->order->id]));
    }

    public function getCustomersProperty()
    {
        return Customer::cursor();
    }

    public function render()
    {
        return view('lean.actions.create_order');
    }
}
