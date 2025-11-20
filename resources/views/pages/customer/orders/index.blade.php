@extends('layouts.app')

@section('title', 'My Orders')

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
                <a href="{{ route('customer.orders.index') }}" class="list-group-item list-group-item-action active">
                    <i class="bi bi-bag me-2"></i> Orders
                </a>
                <a href="{{ route('customer.wishlist.index') }}" class="list-group-item list-group-item-action">
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
                    <h5 class="mb-0">My Orders</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">All Orders</a></li>
                            <li><a class="dropdown-item" href="#">Processing</a></li>
                            <li><a class="dropdown-item" href="#">Shipped</a></li>
                            <li><a class="dropdown-item" href="#">Delivered</a></li>
                            <li><a class="dropdown-item" href="#">Cancelled</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i> You haven't placed any orders yet. Browse our products and place your first order!
                    </div>

                    <!-- Example order items (hidden by default) -->
                    <div class="d-none">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">Order #12345</h6>
                                        <small class="text-muted">Placed on Jan 15, 2023</small>
                                    </div>
                                    <span class="badge bg-success">Delivered</span>
                                </div>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="bi bi-laptop" style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Premium Laptop</h6>
                                        <p class="text-muted small mb-0">Quantity: 1</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <h6 class="text-primary">$1,299</h6>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">Order #12346</h6>
                                        <small class="text-muted">Placed on Jan 20, 2023</small>
                                    </div>
                                    <span class="badge bg-warning text-dark">Processing</span>
                                </div>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="bi bi-headphones" style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Wireless Headphones</h6>
                                        <p class="text-muted small mb-0">Quantity: 1</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <h6 class="text-primary">$199</h6>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
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
