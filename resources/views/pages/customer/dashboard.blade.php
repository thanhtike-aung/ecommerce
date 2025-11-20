@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My Account</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action active">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('customer.profile.show') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                    <a href="{{ route('customer.orders.index') }}" class="list-group-item list-group-item-action">
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
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Welcome, {{ auth()->user()->name }}</h4>
                </div>
                <div class="card-body">
                    <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <i class="bi bi-bag-check fs-1 text-primary"></i>
                                    <h5 class="mt-3">My Orders</h5>
                                    <p>View your order history</p>
                                    <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-primary">View Orders</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <i class="bi bi-heart fs-1 text-primary"></i>
                                    <h5 class="mt-3">My Wishlist</h5>
                                    <p>View your saved items</p>
                                    <a href="{{ route('customer.wishlist.index') }}" class="btn btn-outline-primary">View Wishlist</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <i class="bi bi-person-circle fs-1 text-primary"></i>
                                    <h5 class="mt-3">My Profile</h5>
                                    <p>Edit your account details</p>
                                    <a href="{{ route('customer.profile.show') }}" class="btn btn-outline-primary">Edit Profile</a>
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
