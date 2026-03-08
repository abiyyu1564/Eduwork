@extends('template.layout')
@section('title', "Cart")

@section("content")
    <h1 class="mb-4">Your Cart</h1>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($cartItems as $item)
                <tr>
                    <td class="d-flex align-items-center gap-3">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                        <span>{{ $item['name'] }}</span>
                    </td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                    <td><a href="#" class="btn btn-sm btn-outline-danger">Remove</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Your cart is empty.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(count($cartItems) > 0)
    <div class="d-flex justify-content-end">
        <div class="text-end">
            <h5>Total: Rp {{ number_format(collect($cartItems)->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.') }}</h5>
            <a href="#" class="btn btn-primary mt-2">Checkout</a>
        </div>
    </div>
    @endif
@endsection
