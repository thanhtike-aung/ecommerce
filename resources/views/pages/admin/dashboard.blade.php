@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Admin Dashboard</h4>
                </div>
                <div class="card-body">
                    @php
                        $user = Auth::user();
                        info($user);
                    @endphp
                    <h5>Welcome, {{ auth()->user()->name }}</h5>
                    <p>You are logged in as an administrator.</p>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <i class="bi bi-tags fs-1 text-primary"></i>
                                    <h5 class="mt-3">Manage Brands</h5>
                                    <p>Add, edit, or delete brands</p>
                                    <a href="{{ route('admin.brand.index') }}" class="btn btn-outline-primary">Go to Brands</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <i class="bi bi-people fs-1 text-primary"></i>
                                    <h5 class="mt-3">Manage Users</h5>
                                    <p>View and manage user accounts</p>
                                    <a href="#" class="btn btn-outline-primary">Go to Users</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <i class="bi bi-box-seam fs-1 text-primary"></i>
                                    <h5 class="mt-3">Manage Products</h5>
                                    <p>Add, edit, or delete products</p>
                                    <a href="#" class="btn btn-outline-primary">Go to Products</a>
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
    // Admin dashboard specific scripts can go here
});
</script>
@endpush
