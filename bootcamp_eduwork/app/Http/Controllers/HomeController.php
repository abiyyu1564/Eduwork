<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(6);
        return view('welcome', compact('products'));
    }

    public function cart()
    {
        echo "ini halaman cart";
    }

    public function product()
    {
        $products = Product::with('category')->paginate(6);
        return view('product', compact('products'));
    }

    public function product_detail()
    {
        return view('product_detail');
    }
}
