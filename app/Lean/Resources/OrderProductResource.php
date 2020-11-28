<?php

namespace App\Lean\Resources;

use App\Models\OrderProduct;
use Lean\Fields\ID;
use Lean\Fields\Number;
use Lean\Fields\Relations\BelongsTo;
use Lean\Fields\Text;
use Lean\LeanResource;

class OrderProductResource extends LeanResource
{
    public static string $model = OrderProduct::class;
    public static array $searchable = [
        // This resource would normally not be visible to users, because it's a custom pivot-style table.
        // That said, administrators may want to search order products using e.g. the product_id.
        'id',
        'product_id',
        'order_id',
        'quantity',
    ];
    public static string $title = 'id';
    public static string $icon = 'heroicon-o-shopping-cart';

    public static function label(): string
    {
        return 'Order Product';
    }

    public static function pluralLabel(): string
    {
        return 'Order Products';
    }

    public static function fields(): array
    {
        return [
            ID::make('id'),
            Text::make('name')->display(['create' => false, 'default' => true]),
            Number::make('price')->min(1)->max(1000)->step(1)->display(['create' => false, 'default' => true]),

            Number::make('quantity')->min(1)->step(1),

            BelongsTo::make('order')->parent(OrderResource::class),
            BelongsTo::make('product')->parent(ProductResource::class),
        ];
    }
}
