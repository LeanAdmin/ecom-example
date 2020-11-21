<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function booted()
    {
        parent::booted();

        static::creating(function (self $orderProduct) {
            $orderProduct->name ??= $orderProduct->product->name;
            $orderProduct->price ??= $orderProduct->product->price;
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
