<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin/products', ProductsController::class);

Route::get('/home', [HomeController::class, 'index']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/product', [HomeController::class, 'product']);
Route::get('/product_detail', [HomeController::class, 'product_detail']);