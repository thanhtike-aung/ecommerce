@extends('layouts.app')

@section('title', 'Order Confirmation - ')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.cart.index') }}">Shopping Cart</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.checkout.index') }}">Checkout</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Confirmation</li>
        </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center mb-5">
        <div class="display-1 text-success mb-4">
            <i class="bi bi-check-circle"></i>
        </div>
        <h1 class="mb-3">Thank You for Your Order!</h1>
        <p class="lead">Your order has been placed and is being processed.</p>
        <p>Order Number: <strong>{{ $order->order_number }}</strong></p>
        <p>A confirmation email has been sent to your email address.</p>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Order Details</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Order Information</h6>
                            <p class="mb-1"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                            <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
                            <p class="mb-1"><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($order->status) }}</span></p>
                            <p class="mb-1"><strong>Payment Method:</strong> Cash on Delivery</p>
                            <p class="mb-1"><strong>Payment Status:</strong> <span class="badge bg-warning">{{ ucfirst($order->payment_status) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Customer Information</h6>
                            @php
                                $shippingAddress = json_decode($order->shipping_address);
                            @endphp
                            <p class="mb-1"><strong>Name:</strong> {{ $shippingAddress->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $shippingAddress->email }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $shippingAddress->phone }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Shipping Address</h6>
                            <address>
                                {{ $shippingAddress->name }}<br>
                                {{ $shippingAddress->address }}<br>
                                {{ $shippingAddress->city }}, {{ $shippingAddress->state }} {{ $shippingAddress->zip }}<br>
                                {{ $shippingAddress->country }}
                            </address>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Billing Address</h6>
                            @php
                                $billingAddress = json_decode($order->billing_address);
                            @endphp
                            <address>
                                {{ $billingAddress->name }}<br>
                                {{ $billingAddress->address }}<br>
                                {{ $billingAddress->city }}, {{ $billingAddress->state }} {{ $billingAddress->zip }}<br>
                                {{ $billingAddress->country }}
                            </address>
                        </div>
                    </div>

                    <h6 class="text-muted mb-3">Order Items</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->thumbnail)
                                                    <img src="{{ asset('storage/images/' . $item->product->thumbnail) }}"
                                                         class="img-thumbnail me-3" alt="{{ $item->product_name }}"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center me-3"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="bi bi-box text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product_name }}</h6>
                                                    <small class="text-muted">SKU: {{ $item->product_sku }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">${{ number_format($item->price, 2) }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">${{ number_format($item->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal:</th>
                                    <td class="text-end">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Shipping:</th>
                                    <td class="text-end">Free</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <td class="text-end fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($order->notes)
                        <div class="mt-4">
                            <h6 class="text-muted mb-2">Order Notes</h6>
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('home') }}" class="btn btn-outline-primary">
                    <i class="bi bi-house me-2"></i>Continue Shopping
                </a>
                <a href="{{ route('customer.orders.index') }}" class="btn btn-primary">
                    <i class="bi bi-bag me-2"></i>View My Orders
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
