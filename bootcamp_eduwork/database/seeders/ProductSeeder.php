<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Kategori
        $elektronik = Category::create(['name' => 'Elektronik']);
        $pakaian = Category::create(['name' => 'Pakaian']);

        // 2. Buat Produk Dummy
        Products::create([
            'name' => 'Laptop ASUS ROG',
            'description' => 'Laptop gaming spek dewa.',
            'stock' => 10,
            'image' => 'laptop.jpg',
            'category_id' => $elektronik->id
        ]);

        Products::create([
            'name' => 'Kaos Polos Cotton',
            'description' => 'Bahan nyaman dan adem.',
            'stock' => 50,
            'image' => 'kaos.jpg',
            'category_id' => $pakaian->id
        ]);
    }
}