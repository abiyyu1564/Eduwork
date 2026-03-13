<div class="product-card fade-in-up">
  <div class="card-img-wrapper">
    @if($product->image)
      <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
    @else
      <div class="placeholder-img">
        <i class="bi bi-image"></i>
      </div>
    @endif
    <span class="category-badge">
      <i class="bi bi-tag-fill me-1"></i>{{ $product->category->name ?? 'Tanpa Kategori' }}
    </span>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $product->name }}</h5>
    <p class="card-desc">{{ $product->description }}</p>
    <div class="card-meta">
      <span class="stock-info {{ $product->stock <= 15 ? 'low' : '' }}">
        <i class="bi bi-box-seam"></i>
        Stok: {{ $product->stock }}
      </span>
      <a href="#" class="btn-detail">
        Detail <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>
  </div>
</div>
