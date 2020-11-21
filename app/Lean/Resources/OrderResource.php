<?php

namespace App\Lean\Resources;

use App\Models\Order;
use Lean\Fields\ID;
use Lean\Fields\Relations\BelongsTo;
use Lean\Fields\Relations\HasMany;
use Lean\Livewire\Resources\LeanResource;

class OrderResource extends LeanResource
{
    public static string $model = Order::class;
    public static array $searchable = [
        'id',
        'text',
    ];
    public static string $title = 'id';
    public static string $icon = 'heroicon-o-document-text';

    public static function fields(): array
    {
        return [
            ID::make('id'),
            BelongsTo::make('customer')->parent(CustomerResource::class)->label(__('Buyer')),
            HasMany::make('products')->of(OrderProductResource::class)->label(__('Products')),
        ];
    }
}
