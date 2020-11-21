<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
