<?php

use Illuminate\Support\Facades\Route;
use Lean\Lean;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // If you're running this locally, you may want to use Lean routes
    // inside an auth route group.
    // Lean::routes([
    //     'home' => '/admin/p/home',
    // ]);
});

// For the public demo, we use public routes.
Lean::routes([
    'home' => '/admin/p/home',
]);
