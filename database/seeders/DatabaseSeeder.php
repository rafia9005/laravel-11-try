<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "name" => 'Ahmad Rafi',
            "email" => 'admin@gmail.com',
            "password" => bcrypt("admin123")
        ]);
        Product::create([
            'title' => 'Sepatu baru',
            'price' => '50000',
            'description' => 'sepatu keluaran terbaru murah dan terjangkau.',
            'author' => '1'
        ]);
    }
}
