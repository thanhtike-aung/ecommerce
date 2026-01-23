@extends('layouts.app')

@section('title', 'My Profile')

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
                <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('customer.profile.show') }}" class="list-group-item list-group-item-action active">
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

        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="birthdate" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="birthdate">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Address Information</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city">
                            </div>
                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country">
                                <option selected>Select Country</option>
                                <option value="US">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Address</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password">
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password">
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
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
