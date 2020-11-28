<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('password');

        // Customers
        $taylor = Customer::create([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => $password,
        ]);

        $adam = Customer::create([
            'name' => 'Adam Wathan',
            'email' => 'adam@tailwindcss.com',
            'password' => $password,
        ]);

        $mohamed = Customer::create([
            'name' => 'Mohamed Said',
            'email' => 'mohamed@laravel.com',
            'password' => $password,
        ]);

        // Products
        $mbp16 = Product::create([
            'name' => 'MacBook Pro 16"',
            'description' => 'The <strong>best</strong> one',
            'price' => 800,
        ]);

        $mbp13 = Product::create([
            'name' => 'MacBook Pro 13"',
            'description' => 'The <strong>small</strong> one',
            'price' => 500,
        ]);

        $mba13 = Product::create([
            'name' => 'MacBook Air 13"',
            'description' => 'The <strong>cheap</strong> one',
            'price' => 300,
        ]);

        $stand = Product::create([
            'name' => 'Monitor stand',
            'description' => 'What an <em>expensive</em> monitor stand.',
            'price' => 1000,
        ]);

        $taylor->orders()->create()->products()->createMany([
            [
                'product_id' => $mba13->id,
                'quantity' => 2,
            ],
            [
                'product_id' => $mbp16->id,
                'quantity' => 1,
            ],
        ]);

        $adam->orders()->create()->products()->createMany([
            [
                'product_id' => $mbp13->id,
                'quantity' => 1,
            ],
            [
                'product_id' => $mbp16->id,
                'quantity' => 3,
            ],
            [
                'product_id' => $stand->id,
                'quantity' => 1,
            ],
        ]);

        $mohamed->orders()->create()->products()->createMany([
            [
                'product_id' => $mbp13->id,
                'quantity' => 2,
            ],
        ]);

        // Users
        User::factory(10)->create();
    }
}
