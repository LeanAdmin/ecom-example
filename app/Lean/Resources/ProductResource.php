<?php

namespace App\Lean\Resources;

use App\Models\Model;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Lean\Fields\File;
use Lean\Fields\ID;
use Lean\Fields\Number;
use Lean\Fields\Pikaday;
use Lean\Fields\Text;
use Lean\Fields\Textarea;
use Lean\Fields\Trix;
use Lean\LeanResource;
use Lean\Fields\Image;
use Livewire\TemporaryUploadedFile;

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

            Image::make('image')
                ->height('h-56')
                ->default('https://www.allianceplast.com/wp-content/uploads/2017/11/no-image.png')
                ->resolveUrlUsing(fn (Image $field, string $path) =>
                    filter_var($path, FILTER_VALIDATE_URL)
                    ? $path
                    : ('/storage/' . $path)
                )
                ->storeFileUsing(fn (Image $field, TemporaryUploadedFile $file) => $file->storePublicly('images', ['disk' => 'public']))
                ->deleteFileUsing(fn (Image $image, string $name) => Storage::disk('public')->delete($name)),

            Trix::make('description'),

            Pikaday::make('updated_at')
                ->display('show', 'edit')
                ->placeholder('DD.MM.YYYY')
                ->jsFormat('DD.MM.YYYY')
                ->phpFormat('d.m.Y')
                ->default(now()),

            Pikaday::make('created_at')
                ->display('show')
                ->placeholder('DD.MM.YYYY')
                ->jsFormat('DD.MM.YYYY')
                ->phpFormat('d.m.Y')
                ->default(now()),
        ];
    }
}
