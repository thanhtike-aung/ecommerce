@extends('layouts.admin')

@section('title', 'Edit Order - Nexwear')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Edit Order #{{ $order->order_number }}</h1>
                    <p class="text-muted mb-0">Update order information</p>
                </div>
                <div>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left me-2"></i>Back to Orders
                    </a>
                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-2"></i>View Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.order.update', $order->id) }}" method="POST" id="orderForm">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-person me-2"></i>Customer Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">Customer</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('user_id', $order->user_id) == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} ({{ $customer->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-cart me-2"></i>Order Items
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th width="120">Quantity</th>
                                        <th width="150">Price</th>
                                        <th width="150">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->product_name }} (SKU: {{ $item->product_sku }})</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>${{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-3">No items in this order</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            To modify order items, please create a new order and cancel this one.
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-geo-alt me-2"></i>Shipping & Billing Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Shipping Address</label>
                                    <div class="card">
                                        <div class="card-body p-3">
                                            @php
                                                $shippingAddress = old('shipping_address', $order->shipping_address);
                                                $shippingAddressData = [];

                                                // Try to parse existing address if it's in JSON format
                                                try {
                                                    $decoded = json_decode($shippingAddress, true);
                                                    if (is_array($decoded)) {
                                                        $shippingAddressData = $decoded;
                                                    }
                                                } catch (\Exception $e) {
                                                    // Not JSON, keep as is
                                                }
                                            @endphp

                                            <div class="row g-2">
                                                <div class="col-md-6 mb-2">
                                                    <label for="shipping_name" class="form-label small">Full Name</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_name" name="shipping_address_data[name]" value="{{ $shippingAddressData['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="shipping_phone" class="form-label small">Phone</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_phone" name="shipping_address_data[phone]" value="{{ $shippingAddressData['phone'] ?? '' }}">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="shipping_street" class="form-label small">Street Address</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_street" name="shipping_address_data[street]" value="{{ $shippingAddressData['street'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="shipping_city" class="form-label small">City</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_city" name="shipping_address_data[city]" value="{{ $shippingAddressData['city'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="shipping_state" class="form-label small">State/Province</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_state" name="shipping_address_data[state]" value="{{ $shippingAddressData['state'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="shipping_zip" class="form-label small">ZIP/Postal Code</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_zip" name="shipping_address_data[zip]" value="{{ $shippingAddressData['zip'] ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="shipping_country" class="form-label small">Country</label>
                                                    <input type="text" class="form-control form-control-sm" id="shipping_country" name="shipping_address_data[country]" value="{{ $shippingAddressData['country'] ?? '' }}">
                                                </div>
                                            </div>
                                            <!-- Hidden field to store the JSON representation -->
                                            <input type="hidden" id="shipping_address" name="shipping_address" value="{{ $shippingAddress }}">
                                        </div>
                                    </div>
                                    @error('shipping_address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Billing Address</label>
                                    <div class="card">
                                        <div class="card-body p-3">
                                            @php
                                                $billingAddress = old('billing_address', $order->billing_address);
                                                $billingAddressData = [];

                                                // Try to parse existing address if it's in JSON format
                                                try {
                                                    $decoded = json_decode($billingAddress, true);
                                                    if (is_array($decoded)) {
                                                        $billingAddressData = $decoded;
                                                    }
                                                } catch (\Exception $e) {
                                                    // Not JSON, keep as is
                                                }
                                            @endphp

                                            <div class="row g-2">
                                                <div class="col-md-6 mb-2">
                                                    <label for="billing_name" class="form-label small">Full Name</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_name" name="billing_address_data[name]" value="{{ $billingAddressData['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="billing_phone" class="form-label small">Phone</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_phone" name="billing_address_data[phone]" value="{{ $billingAddressData['phone'] ?? '' }}">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="billing_street" class="form-label small">Street Address</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_street" name="billing_address_data[street]" value="{{ $billingAddressData['street'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="billing_city" class="form-label small">City</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_city" name="billing_address_data[city]" value="{{ $billingAddressData['city'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="billing_state" class="form-label small">State/Province</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_state" name="billing_address_data[state]" value="{{ $billingAddressData['state'] ?? '' }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="billing_zip" class="form-label small">ZIP/Postal Code</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_zip" name="billing_address_data[zip]" value="{{ $billingAddressData['zip'] ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="billing_country" class="form-label small">Country</label>
                                                    <input type="text" class="form-control form-control-sm" id="billing_country" name="billing_address_data[country]" value="{{ $billingAddressData['country'] ?? '' }}">
                                                </div>
                                            </div>
                                            <!-- Hidden field to store the JSON representation -->
                                            <input type="hidden" id="billing_address" name="billing_address" value="{{ $billingAddress }}">
                                        </div>
                                    </div>
                                    @error('billing_address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="sameAsShipping">
                                    <label class="form-check-label" for="sameAsShipping">
                                        Same as shipping address
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shipping_method" class="form-label">Shipping Method</label>
                                    <select class="form-select @error('shipping_method') is-invalid @enderror" id="shipping_method" name="shipping_method">
                                        <option value="">Select Shipping Method</option>
                                        <option value="standard" {{ old('shipping_method', $order->shipping_method) == 'standard' ? 'selected' : '' }}>Standard Shipping</option>
                                        <option value="express" {{ old('shipping_method', $order->shipping_method) == 'express' ? 'selected' : '' }}>Express Shipping</option>
                                        <option value="overnight" {{ old('shipping_method', $order->shipping_method) == 'overnight' ? 'selected' : '' }}>Overnight Shipping</option>
                                    </select>
                                    @error('shipping_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tracking_number" class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control @error('tracking_number') is-invalid @enderror" id="tracking_number" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}">
                                    @error('tracking_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-credit-card me-2"></i>Payment Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                                        <option value="">Select Payment Method</option>
                                        <option value="credit_card" {{ old('payment_method', $order->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="paypal" {{ old('payment_method', $order->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="bank_transfer" {{ old('payment_method', $order->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="cash_on_delivery" {{ old('payment_method', $order->payment_method) == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_status" class="form-label">Payment Status</label>
                                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                                        <option value="pending" {{ old('payment_status', $order->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="failed" {{ old('payment_status', $order->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ old('payment_status', $order->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                    @error('payment_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-gear me-2"></i>Order Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Order Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="refunded" {{ old('status', $order->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Order Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $order->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mb-5">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none me-2"></span>
                        <i class="bi bi-check-circle me-2"></i>Update Order
                    </button>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Function to update address JSON
    function updateAddressJson(type) {
        const addressData = {};
        $(`[name^="${type}_address_data"]`).each(function() {
            const fieldName = $(this).attr('name').match(/\[(.*?)\]/)[1];
            addressData[fieldName] = $(this).val();
        });
        $(`#${type}_address`).val(JSON.stringify(addressData));
    }

    // Update JSON when input fields change
    $('[name^="shipping_address_data"]').on('change', function() {
        updateAddressJson('shipping');
    });

    $('[name^="billing_address_data"]').on('change', function() {
        updateAddressJson('billing');
    });

    // Same as shipping address checkbox
    $('#sameAsShipping').on('change', function() {
        if ($(this).is(':checked')) {
            // Copy all shipping fields to billing fields
            $('[name^="shipping_address_data"]').each(function() {
                const fieldName = $(this).attr('name').match(/\[(.*?)\]/)[1];
                $(`#billing_${fieldName}`).val($(this).val());
            });
            updateAddressJson('billing');
        }
    });

    // Initialize JSON values
    updateAddressJson('shipping');
    updateAddressJson('billing');

    // Form submission
    $('#orderForm').on('submit', function(e) {
        // Show loading spinner
        $('#submitBtn').prop('disabled', true);
        $('#submitBtn .spinner-border').removeClass('d-none');
    });
});
</script>
@endpush
