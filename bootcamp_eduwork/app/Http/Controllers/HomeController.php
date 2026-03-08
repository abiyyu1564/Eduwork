<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = [
            ['name' => 'Product 1', 'price' => 100, 'image' => 'https://static.motor.es/fotos-jato/byd/uploads/byd-seal-6441b4e361e74.jpg'],
            ['name' => 'Product 2', 'price' => 200, 'image' => 'https://static.motor.es/fotos-jato/byd/uploads/byd-seal-6441b4e361e74.jpg'],
            ['name' => 'Product 3', 'price' => 300, 'image' => 'https://static.motor.es/fotos-jato/byd/uploads/byd-seal-6441b4e361e74.jpg'],
        ];
        return view('welcome', compact('products'));
    }

    public function cart()
    {
        echo "ini halaman cart";
    }

    public function product()
    {
        return view('product');
    }

    public function product_detail()
    {
        return view('product_detail');
    }
}
