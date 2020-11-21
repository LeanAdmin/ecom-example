<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\Artisan;

class Model extends EloquentModel
{
    use HasFactory;

    protected $guarded = [];

    public static function booted()
    {
        static::deleted(function () {
            if (static::count() === 0) {
                // Deleting some resources results in the demo crashing, so this way we ensure infinite data.
                Artisan::call('migrate:fresh --force --seed');
            }
        });
    }
}
