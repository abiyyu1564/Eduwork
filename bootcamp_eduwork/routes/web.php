<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

// use HomeController for home page so products data is available
Route::get('/', [HomeController::class, 'index']);

Route::resource('admin/products', ProductsController::class);

Route::get('/home', [HomeController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/product', [HomeController::class, 'product']);
Route::get('/product_detail', [HomeController::class, 'product_detail']);