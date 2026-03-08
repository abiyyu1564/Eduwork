<div class="card h-100 shadow-sm">
  <img src="{{ $products['image'] }}" class="card-img-top" alt="{{ $products['name'] }}" style="height: 200px; object-fit: cover;">
  <div class="card-body d-flex flex-column">
    <h5 class="card-title">{{ $products['name'] }}</h5>
    <p class="card-text fw-bold text-primary">Rp {{ number_format($products['price'],0,',','.') }}</p>
    <a href="#" class="btn btn-primary mt-auto">Go somewhere</a>
  </div>
</div>
