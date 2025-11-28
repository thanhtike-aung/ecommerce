@extends('layouts.admin')

@section('title', 'Create Order - ShopZone')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Create New Order</h1>
                    <p class="text-muted mb-0">Create a new order manually</p>
                </div>
                <div>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Form -->
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.order.store') }}" method="POST" id="orderForm">
                @csrf

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-person me-2"></i>Customer Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">Select Customer <span class="text-danger">*</span></label>
                                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
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
                            <table class="table table-bordered" id="orderItemsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th width="120">Quantity</th>
                                        <th width="150">Price</th>
                                        <th width="150">Total</th>
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="emptyRow">
                                        <td colspan="5" class="text-center py-3">No items added yet</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="fw-bold" id="orderTotal">$0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Add Product</label>
                                    <select class="form-select" id="product_id">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->getCurrentPrice() }}" data-name="{{ $product->name }}">
                                                {{ $product->name }} - ${{ number_format($product->getCurrentPrice(), 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" min="1" value="1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary" id="addItemBtn">
                                            <i class="bi bi-plus-circle me-2"></i>Add Item
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                                    <label for="shipping_address" class="form-label">Shipping Address</label>
                                    <textarea class="form-control @error('shipping_address') is-invalid @enderror" id="shipping_address" name="shipping_address" rows="3">{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="billing_address" class="form-label">Billing Address</label>
                                    <textarea class="form-control @error('billing_address') is-invalid @enderror" id="billing_address" name="billing_address" rows="3">{{ old('billing_address') }}</textarea>
                                    @error('billing_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                                        <option value="standard" {{ old('shipping_method') == 'standard' ? 'selected' : '' }}>Standard Shipping</option>
                                        <option value="express" {{ old('shipping_method') == 'express' ? 'selected' : '' }}>Express Shipping</option>
                                        <option value="overnight" {{ old('shipping_method') == 'overnight' ? 'selected' : '' }}>Overnight Shipping</option>
                                    </select>
                                    @error('shipping_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tracking_number" class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control @error('tracking_number') is-invalid @enderror" id="tracking_number" name="tracking_number" value="{{ old('tracking_number') }}">
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
                                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }} disabled>Credit Card</option>
                                        <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }} disabled>PayPal</option>
                                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }} disabled>Bank Transfer</option>
                                        <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
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
                                        <option value="pending" {{ old('payment_status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="failed" {{ old('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
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
                                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Order Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
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
                            <i class="bi bi-cart me-2"></i>Order Summary
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Subtotal</td>
                                        <td class="text-end" id="summarySubtotal">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Shipping</td>
                                        <td class="text-end" id="summaryShipping">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tax</td>
                                        <td class="text-end" id="summaryTax">$0.00</td>
                                    </tr>
                                    <tr class="table-active">
                                        <td class="fw-bold">Total</td>
                                        <td class="text-end fw-bold" id="summaryTotal">$0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="total_amount" id="totalAmountInput" value="0">
                    </div>
                </div>

                <!-- Hidden fields for order items -->
                <div id="orderItemsContainer"></div>

                <div class="d-flex gap-2 mb-5">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none me-2"></span>
                        <i class="bi bi-check-circle me-2"></i>Create Order
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
    let orderItems = [];
    let itemCounter = 0;
    let shippingCost = 0;
    let taxRate = 0.1; // 10% tax rate

    // Add item to order
    $('#addItemBtn').on('click', function() {
        const productId = $('#product_id').val();
        const quantity = parseInt($('#quantity').val());

        if (!productId) {
            showToast('Please select a product', 'warning');
            return;
        }

        if (!quantity || quantity < 1) {
            showToast('Please enter a valid quantity', 'warning');
            return;
        }

        const productOption = $('#product_id option:selected');
        const productName = productOption.data('name');
        const price = parseFloat(productOption.data('price'));
        const total = price * quantity;

        // Add to order items array
        const item = {
            id: ++itemCounter,
            product_id: productId,
            quantity: quantity,
            price: price,
            total: total
        };

        orderItems.push(item);

        // Add to table
        addItemToTable(item, productName);

        // Update order total
        updateOrderTotal();

        // Reset form
        $('#product_id').val('');
        $('#quantity').val(1);

        // Show success message
        showToast('Item added to order', 'success');
    });

    // Remove item from order
    $(document).on('click', '.remove-item', function() {
        const itemId = $(this).data('id');

        // Remove from array
        orderItems = orderItems.filter(item => item.id !== itemId);

        // Remove from table
        $(this).closest('tr').remove();

        // Update order total
        updateOrderTotal();

        // Show empty row if no items
        if (orderItems.length === 0) {
            $('#emptyRow').show();
        }
    });

    // Update shipping cost when shipping method changes
    $('#shipping_method').on('change', function() {
        const method = $(this).val();

        // Set shipping cost based on method
        if (method === 'express') {
            shippingCost = 15;
        } else if (method === 'overnight') {
            shippingCost = 25;
        } else {
            // standard or empty
            shippingCost = 5;
        }

        // Update order summary
        updateOrderTotal();
    });

    // Same as shipping address checkbox
    $('#sameAsShipping').on('change', function() {
        if ($(this).is(':checked')) {
            $('#billing_address').val($('#shipping_address').val());
        }
    });

    // Update billing address when shipping address changes if checkbox is checked
    $('#shipping_address').on('input', function() {
        if ($('#sameAsShipping').is(':checked')) {
            $('#billing_address').val($(this).val());
        }
    });

    // Form submission
    $('#orderForm').on('submit', function(e) {
        // Validate form
        if (!validateForm()) {
            e.preventDefault();
            return false;
        }

        // Add order items as hidden fields
        $('#orderItemsContainer').empty();
        orderItems.forEach((item, index) => {
            $('#orderItemsContainer').append(`
                <input type="hidden" name="items[${index}][product_id]" value="${item.product_id}">
                <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
                <input type="hidden" name="items[${index}][options]" value="">
            `);
        });

        // Show loading spinner
        $('#submitBtn').prop('disabled', true);
        $('#submitBtn .spinner-border').removeClass('d-none');
    });

    // Helper functions
    function addItemToTable(item, productName) {
        // Hide empty row
        $('#emptyRow').hide();

        // Add item row
        $('#orderItemsTable tbody').append(`
            <tr>
                <td>${productName}</td>
                <td>${item.quantity}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>$${item.total.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item" data-id="${item.id}">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `);
    }

    function updateOrderTotal() {
        // Calculate subtotal from items
        const subtotal = orderItems.reduce((sum, item) => sum + item.total, 0);

        // Calculate tax
        const tax = subtotal * taxRate;

        // Calculate total
        const total = subtotal + tax + shippingCost;

        // Update order items table total
        $('#orderTotal').text('$' + subtotal.toFixed(2));

        // Update summary section
        $('#summarySubtotal').text('$' + subtotal.toFixed(2));
        $('#summaryShipping').text('$' + shippingCost.toFixed(2));
        $('#summaryTax').text('$' + tax.toFixed(2));
        $('#summaryTotal').text('$' + total.toFixed(2));

        // Update hidden input for total amount
        $('#totalAmountInput').val(total.toFixed(2));
    }

    function validateForm() {
        // Check if customer is selected
        if (!$('#user_id').val()) {
            showToast('Please select a customer', 'warning');
            $('#user_id').focus();
            return false;
        }

        // Check if at least one item is added
        if (orderItems.length === 0) {
            showToast('Please add at least one item to the order', 'warning');
            $('#product_id').focus();
            return false;
        }

        return true;
    }

    // Initialize shipping cost based on default selection
    $('#shipping_method').trigger('change');
});
</script>
@endpush
