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
                <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
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
                            <li><a class="dropdown-item" href="{{ route('customer.orders.index') }}">All Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.orders.index', ['status' => 'processing']) }}">Processing</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.orders.index', ['status' => 'shipped']) }}">Shipped</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.orders.index', ['status' => 'delivered']) }}">Delivered</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.orders.index', ['status' => 'cancelled']) }}">Cancelled</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $status = request()->query('status');
                        $query = \App\Models\Order::where('user_id', auth()->id());

                        if ($status) {
                            $query->where('status', $status);
                        }

                        $orders = $query->orderBy('created_at', 'desc')->get();
                    @endphp

                    @if($orders->isEmpty())
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            @if(request()->query('status'))
                                You don't have any {{ request()->query('status') }} orders.
                            @else
                                You haven't placed any orders yet. Browse our products and place your first order!
                            @endif
                        </div>
                    @else
                        @foreach($orders as $order)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">Order #{{ $order->order_number }}</h6>
                                        <small class="text-muted">Placed on {{ $order->created_at->format('M d, Y') }}</small>
                                    </div>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        if($order->status == 'processing') {
                                            $statusClass = 'bg-warning text-dark';
                                        } elseif($order->status == 'shipped') {
                                            $statusClass = 'bg-info';
                                        } elseif($order->status == 'delivered') {
                                            $statusClass = 'bg-success';
                                        } elseif($order->status == 'cancelled') {
                                            $statusClass = 'bg-danger';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                </div>
                                <hr>
                                @php
                                    // Get the first item to display as preview
                                    $firstItem = $order->orderItems->first();
                                    $itemCount = $order->orderItems->count();
                                @endphp
                                @if($firstItem)
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        @if($firstItem->product && $firstItem->product->thumbnail)
                                            <img src="{{ asset('storage/images/' . $firstItem->product->thumbnail) }}" alt="{{ $firstItem->product_name }}" class="img-fluid" style="height: 80px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 80px;">
                                                <i class="bi bi-box" style="font-size: 2rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h6>{{ $firstItem->product_name }}</h6>
                                        <p class="text-muted small mb-0">
                                            Quantity: {{ $firstItem->quantity }}
                                            @if($itemCount > 1)
                                                <span class="ms-2">+ {{ $itemCount - 1 }} more item(s)</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <h6 class="text-primary">${{ number_format($order->total_amount, 2) }}</h6>
                                        <a href="{{ route('customer.checkout.confirmation', $order->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endif
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
            data: {
                _token: '{{ csrf_token() }}',
            },
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
