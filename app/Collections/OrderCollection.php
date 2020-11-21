<?php

namespace App\Collections;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderCollection extends Collection
{
    public function total()
    {
        return $this->sum(function (Order $order) {
            return $order->products->sum('total');
        });
    }
}
