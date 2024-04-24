<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);

        Product::insert([
            [
                "name" => "riki",
                "image" => "https://source.unsplash.com/random/",
                "price" => 2000,
                "description" => "riki",
            ],
            [
                "name" => "ruku",
                "image" => "https://source.unsplash.com/random/",
                "price" => 1500,
                "description" => "ruku",
            ]
        ]);
    }
}
