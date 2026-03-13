<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <i class="bi bi-bag-heart-fill me-1"></i> EduShop
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto gap-1">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="bi bi-house-door me-1"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('product') ? 'active' : '' }}" href="{{ url('/product') }}">
            <i class="bi bi-grid me-1"></i>Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('cart') ? 'active' : '' }}" href="{{ url('/cart') }}">
            <i class="bi bi-cart3 me-1"></i>Cart
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>