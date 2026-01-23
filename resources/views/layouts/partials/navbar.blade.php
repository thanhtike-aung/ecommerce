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
                    <a class="nav-link {{ request()->routeIs('customer.products.*') ? 'active' : '' }}" href="{{ route('customer.products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.brands.*') ? 'active' : '' }}" href="{{ route('customer.brands.index') }}">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.categories.*') ? 'active' : '' }}" href="{{ route('customer.categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.about.*') ? 'active' : '' }}" href="{{ route('customer.about.index') }}">About Us</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.products.index') }}"><i class="bi bi-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.wishlist.index') }}"><i class="bi bi-heart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.cart.*') ? 'active' : '' }}" href="{{ route('customer.cart.index') }}">
                        <i class="bi bi-cart3"></i>
                        @php
                            $cartCount = 0;
                            if (auth()->check()) {
                                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                            } else {
                                $sessionId = session()->get('cart_session_id');
                                $cart = $sessionId ? \App\Models\Cart::where('session_id', $sessionId)->first() : null;
                            }
                            if ($cart) {
                                $cartCount = $cart->total_quantity;
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span class="badge bg-danger rounded-pill cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                @include('ui.components.nav-profile')
            </ul>
        </div>
    </div>
</nav>
