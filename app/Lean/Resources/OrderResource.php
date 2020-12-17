<?php

namespace App\Lean\Resources;

use App\Lean\Actions\CreateOrderAction;
use App\Models\Order;
use Lean\Fields\ID;
use Lean\Fields\Number;
use Lean\Fields\Relations\BelongsTo;
use Lean\Fields\Relations\HasMany;
use Lean\Fields\Text;
use Lean\LeanResource;

class OrderResource extends LeanResource
{
    public static string $model = Order::class;
    public static array $searchable = [
        'id',
    ];
    public static string $title = 'id';
    public static string $icon = 'heroicon-o-document-text';

    public static function fields(): array
    {
        return [
            ID::make('id'),

            Text::make('total')
                ->resolveValueUsing(fn ($text, $model) => '$' . $model->total)
                ->stored(false),

            BelongsTo::make('customer')
                ->parent(CustomerResource::class)
                ->label(__('Buyer')),

            HasMany::make('products')
                ->of(OrderProductResource::class)
                ->resultsPerPage(2)
                ->label(__('Products'))
                ->fields([
                    Text::make('name'),
                    Number::make('price'),
                    Number::make('quantity'),
                    Text::make('total')
                        ->resolveValueUsing(fn ($text, $model) => '$' . $model->total),
                ]),
        ];
    }

    public static function customActions(): array
    {
        return [
            'create' => CreateOrderAction::class,
        ];
    }
}
