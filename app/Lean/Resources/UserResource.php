<?php

namespace App\Lean\Resources;

use App\Models\Customer;
use App\Models\User;
use Lean\Fields\Email;
use Lean\Fields\ID;
use Lean\Fields\Password;
use Lean\Fields\Text;
use Lean\LeanResource;

class UserResource extends LeanResource
{
    public static string $model = User::class;
    public static array $searchable = [
        'id',
        'name',
        'email',
    ];
    public static ?int $resultsPerPage = 3;
    public static string $title = 'name';
    public static string $icon = 'heroicon-o-user-circle';

    public static function fields(): array
    {
        return [
            ID::make('id'),
            Text::make('name'),
            Email::make('email'),
            Password::make('password')->confirmed(),
            Password::make('password_confirmation')->stored(false)->label('Password confirmation'),
        ];
    }
}
