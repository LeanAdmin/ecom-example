<?php

namespace App\Lean\Resources;

use App\Models\OrderProduct;
use App\Models\Product;
use Lean\Fields\ID;
use Lean\Fields\Number;
use Lean\Fields\Text;
use Lean\Livewire\Resources\LeanResource;

class ProductResource extends LeanResource
{
    public static string $model = Product::class;
    public static array $searchable = [
        'id',
        'name',
    ];
    public static string $title = 'name';
    public static string $icon = 'heroicon-o-color-swatch';

    public static function fields(): array
    {
        return [
            ID::make('id'),
            Text::make('name'),
            Number::make('price')->min(1)->max(100)->step(1),

            // Computed field
            Text::make('Ordered')->resolveValueUsing(function ($text, Product $product) {
                return $product->order_products->sum('quantity') . ' times';
            })->stored(false)->display(['read' => true, 'write' => false]),
        ];
    }
}
