@extends('layouts.app')

@section('title', 'My Wishlist')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    @if (auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="rounded-circle mb-3" width="100" height="100">
                    @else
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px;">
                            <span class="text-white fw-bold" style="font-size: 2rem;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="list-group mt-4 shadow-sm">
                <a href="{{ route('customer.profile.show') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
                <a href="{{ route('customer.orders.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-bag me-2"></i> Orders
                </a>
                <a href="{{ route('customer.wishlist.index') }}" class="list-group-item list-group-item-action active">
                    <i class="bi bi-heart me-2"></i> Wishlist
                </a>
                <a href="#" id="logout" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Wishlist</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i> Your wishlist is empty. Browse our products and add items to your wishlist!
                    </div>

                    <!-- Example wishlist items (hidden by default) -->
                    <div class="d-none">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="card product-card h-100">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <button class="btn btn-sm btn-danger rounded-circle">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="product-image">
                                        <i class="bi bi-laptop"></i>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Premium Laptop</h5>
                                        <p class="card-text text-muted">High-performance laptop for professionals</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 text-primary mb-0">$1,299</span>
                                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="card product-card h-100">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <button class="btn btn-sm btn-danger rounded-circle">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="product-image">
                                        <i class="bi bi-headphones"></i>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Wireless Headphones</h5>
                                        <p class="card-text text-muted">Premium sound quality headphones</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 text-primary mb-0">$199</span>
                                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="card product-card h-100">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <button class="btn btn-sm btn-danger rounded-circle">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <div class="product-image">
                                        <i class="bi bi-watch"></i>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Smart Watch</h5>
                                        <p class="card-text text-muted">Advanced fitness and health tracking</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 text-primary mb-0">$299</span>
                                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#logout').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/customer/logout',
            type: 'POST',
            success: function(response) {
                window.location.href = '/';
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
</script>
@endpush
