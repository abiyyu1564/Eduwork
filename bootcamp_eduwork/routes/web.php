<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cart', function () {
    echo "ini halaman cart";
});

Route::get('/products', function () {
    echo "ini halaman products";
});
Route::get('/checkout', function () {
    echo "ini halaman checkout";
});
