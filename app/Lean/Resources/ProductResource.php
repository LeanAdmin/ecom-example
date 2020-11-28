<?php

namespace App\Lean\Resources;

use App\Models\OrderProduct;
use App\Models\Product;
use Lean\Fields\ID;
use Lean\Fields\Number;
use Lean\Fields\Pikaday;
use Lean\Fields\Text;
use Lean\Fields\Textarea;
use Lean\Fields\Trix;
use Lean\LeanResource;

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
            Number::make('price')->min(1)->max(1000)->step(1),

            // Computed field
            Text::make('Ordered')->resolveValueUsing(function ($text, Product $product) {
                return $product->order_products->sum('quantity') . ' times';
            })->stored(false)->display([
                'read' => true,
                'write' => false,
            ]),

            Trix::make('description'),

            Pikaday::make('updated_at')
                ->display(['create' => false, 'default' => true])
                ->placeholder('DD.MM.YYYY')
                ->jsFormat('DD.MM.YYYY')
                ->phpFormat('d.m.Y')
                ->default(now()),

            Pikaday::make('created_at')
                ->display(['create' => false, 'default' => true])
                ->enabled(false)
                ->placeholder('DD.MM.YYYY')
                ->jsFormat('DD.MM.YYYY')
                ->phpFormat('d.m.Y')
                ->default(now()),
        ];
    }
}
