<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $totalClicks = Product::sum('clicks');

        return view('dashboard', compact('productCount', 'categoryCount', 'totalClicks'));
    }
}
