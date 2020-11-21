<?php

namespace App\Lean\Resources;

use App\Models\Customer;
use Lean\Fields\Email;
use Lean\Fields\ID;
use Lean\Fields\Password;
use Lean\Fields\Relations\HasMany;
use Lean\Fields\Text;
use Lean\Livewire\Resources\LeanResource;

class CustomerResource extends LeanResource
{
    public static string $model = Customer::class;
    public static array $searchable = [
        'id',
        'name',
        'email',
    ];
    public static string $title = 'name';
    public static ?int $resultsPerPage = 2;
    public static string $icon = 'heroicon-o-user';

    public static function fields(): array
    {
        return [
            ID::make('id'),
            Text::make('name'),
            Email::make('email'),
            Password::make('password')->confirmed(),
            Password::make('password_confirmation')->stored(false)->label('Password confirmation'),
            HasMany::make('orders')->of(OrderResource::class),
        ];
    }
}
