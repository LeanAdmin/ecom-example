<?php

namespace App\Models;

use App\Collections\OrderCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getTotalAttribute()
    {
        return $this->products->sum('total');
    }

    public function newCollection(array $models = [])
    {
        return new OrderCollection($models);
    }
}
