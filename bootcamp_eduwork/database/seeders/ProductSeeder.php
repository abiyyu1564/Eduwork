<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Kategori
        $elektronik = Category::create(['name' => 'Elektronik']);
        $pakaian    = Category::create(['name' => 'Pakaian']);
        $makanan    = Category::create(['name' => 'Makanan & Minuman']);
        $olahraga   = Category::create(['name' => 'Olahraga']);

        // 2. Buat Produk Dummy (10+ items supaya pagination terlihat)
        Product::create([
            'name'        => 'Laptop ASUS ROG',
            'description' => 'Laptop gaming spek dewa.',
            'stock'       => 10,
            'image'       => 'laptop.jpg',
            'category_id' => $elektronik->id,
        ]);

        Product::create([
            'name'        => 'Samsung Galaxy S24',
            'description' => 'Smartphone flagship Samsung terbaru.',
            'stock'       => 25,
            'image'       => 'samsung.jpg',
            'category_id' => $elektronik->id,
        ]);

        Product::create([
            'name'        => 'Sony WH-1000XM5',
            'description' => 'Headphone wireless noise-cancelling terbaik.',
            'stock'       => 30,
            'image'       => 'headphone.jpg',
            'category_id' => $elektronik->id,
        ]);

        Product::create([
            'name'        => 'iPad Pro M2',
            'description' => 'Tablet premium dari Apple dengan chip M2.',
            'stock'       => 15,
            'image'       => 'ipad.jpg',
            'category_id' => $elektronik->id,
        ]);

        Product::create([
            'name'        => 'Kaos Polos Cotton',
            'description' => 'Bahan nyaman dan adem.',
            'stock'       => 50,
            'image'       => 'kaos.jpg',
            'category_id' => $pakaian->id,
        ]);

        Product::create([
            'name'        => 'Jaket Hoodie Fleece',
            'description' => 'Hoodie hangat untuk musim hujan.',
            'stock'       => 35,
            'image'       => 'hoodie.jpg',
            'category_id' => $pakaian->id,
        ]);

        Product::create([
            'name'        => 'Celana Jeans Slim Fit',
            'description' => 'Jeans modern slim fit nyaman dipakai.',
            'stock'       => 40,
            'image'       => 'jeans.jpg',
            'category_id' => $pakaian->id,
        ]);

        Product::create([
            'name'        => 'Kopi Arabica Gayo',
            'description' => 'Biji kopi arabica premium dari Aceh.',
            'stock'       => 100,
            'image'       => 'kopi.jpg',
            'category_id' => $makanan->id,
        ]);

        Product::create([
            'name'        => 'Teh Hijau Organik',
            'description' => 'Teh hijau organik tanpa pestisida.',
            'stock'       => 80,
            'image'       => 'teh.jpg',
            'category_id' => $makanan->id,
        ]);

        Product::create([
            'name'        => 'Sepatu Lari Nike',
            'description' => 'Sepatu running ringan dan nyaman.',
            'stock'       => 20,
            'image'       => 'sepatu.jpg',
            'category_id' => $olahraga->id,
        ]);

        Product::create([
            'name'        => 'Raket Badminton Yonex',
            'description' => 'Raket badminton profesional.',
            'stock'       => 15,
            'image'       => 'raket.jpg',
            'category_id' => $olahraga->id,
        ]);

        Product::create([
            'name'        => 'Dumbbell Set 20kg',
            'description' => 'Set dumbbell adjustable untuk home gym.',
            'stock'       => 12,
            'image'       => 'dumbbell.jpg',
            'category_id' => $olahraga->id,
        ]);
    }
}