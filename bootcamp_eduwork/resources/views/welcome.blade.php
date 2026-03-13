@extends('template.layout')
@section('title', "Welcome")

@section("content")
    <div class="page-header">
        <h1>Welcome to EduShop <span style="font-size:1.6rem;">👋</span></h1>
        <p>Temukan produk favoritmu dari berbagai kategori</p>
    </div>

    <div class="row g-4 product-grid">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <x-productCard :product="$product" />
            </div>
        @empty 
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: var(--gray);"></i>
                    <p class="mt-3 text-muted">Belum ada produk tersedia.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="pagination-wrapper d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection