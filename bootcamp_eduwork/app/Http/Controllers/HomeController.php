<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
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
