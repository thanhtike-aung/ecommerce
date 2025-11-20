<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm {{ isset($isFixed) && $isFixed ? 'fixed-top' : '' }}">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-shop text-primary"></i> Nexwear
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('home') }}#products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.brands.*') ? 'active' : '' }}" href="{{ route('customer.brands.index') }}">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ route('home') }}#categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ route('home') }}#about">About</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.wishlist.index') }}"><i class="bi bi-heart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-cart3"></i> <span class="badge bg-primary">0</span></a>
                </li>
                @include('ui.components.nav-profile')
            </ul>
        </div>
    </div>
</nav>
