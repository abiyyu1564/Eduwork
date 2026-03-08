@extends('template.layout')
@section('title', "Welcome Page")

@section("content")
    <h1 class="mb-4">Welcome to Our Website</h1>
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <x-productCard :products="$product" />
            </div>
        @empty 
            <div class="col-12">
                <p>No products available.</p>
            </div>
        @endforelse
    </div>
@endsection