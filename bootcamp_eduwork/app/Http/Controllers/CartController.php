<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
        public function index()
        {
            $cartItems = [
                ['name' => 'Product 1', 'price' => 100, 'image' => 'https://static.motor.es/fotos-jato/byd/uploads/byd-seal-6441b4e361e74.jpg', 'qty' => 1],
                ['name' => 'Product 2', 'price' => 200, 'image' => 'https://static.motor.es/fotos-jato/byd/uploads/byd-seal-6441b4e361e74.jpg', 'qty' => 2],
            ];
            return view('cart', compact('cartItems'));
        }
}
