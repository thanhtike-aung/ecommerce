@extends('layouts.admin')

@section('title', 'Order Details - ShopZone')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Order #{{ $order->order_number }}</h1>
                    <p class="text-muted mb-0">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left me-2"></i>Back to Orders
                    </a>
                    <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil me-2"></i>Edit Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Order Status</h6>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-{{
                                    $order->status == 'completed' ? 'success' :
                                    ($order->status == 'processing' ? 'info' :
                                    ($order->status == 'cancelled' ? 'danger' :
                                    ($order->status == 'refunded' ? 'secondary' : 'warning')))
                                }} me-2">{{ ucfirst($order->status) }}</span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="orderStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Update
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="orderStatusDropdown">
                                        <li><a class="dropdown-item status-update" href="#" data-status="pending" data-order-id="{{ $order->id }}">Pending</a></li>
                                        <li><a class="dropdown-item status-update" href="#" data-status="processing" data-order-id="{{ $order->id }}">Processing</a></li>
                                        <li><a class="dropdown-item status-update" href="#" data-status="completed" data-order-id="{{ $order->id }}">Completed</a></li>
                                        <li><a class="dropdown-item status-update" href="#" data-status="cancelled" data-order-id="{{ $order->id }}">Cancelled</a></li>
                                        <li><a class="dropdown-item status-update" href="#" data-status="refunded" data-order-id="{{ $order->id }}">Refunded</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1">Total Amount</h6>
                            <h3 class="mb-0">${{ number_format($order->total_amount, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Payment Status</h6>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-{{
                                    $order->payment_status == 'paid' ? 'success' :
                                    ($order->payment_status == 'failed' ? 'danger' :
                                    ($order->payment_status == 'refunded' ? 'secondary' : 'warning'))
                                }} me-2">{{ ucfirst($order->payment_status) }}</span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="paymentStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Update
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="paymentStatusDropdown">
                                        <li><a class="dropdown-item payment-status-update" href="#" data-status="pending" data-order-id="{{ $order->id }}">Pending</a></li>
                                        <li><a class="dropdown-item payment-status-update" href="#" data-status="paid" data-order-id="{{ $order->id }}">Paid</a></li>
                                        <li><a class="dropdown-item payment-status-update" href="#" data-status="failed" data-order-id="{{ $order->id }}">Failed</a></li>
                                        <li><a class="dropdown-item payment-status-update" href="#" data-status="refunded" data-order-id="{{ $order->id }}">Refunded</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1">Payment Method</h6>
                            <h5 class="mb-0">{{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'Not Specified')) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-cart me-2"></i>Order Items
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->thumbnail)
                                                    <img src="{{ asset('storage/images/' . $item->product->thumbnail) }}" alt="{{ $item->product_name }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-box-seam text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product_name }}</h6>
                                                    <small class="text-muted">SKU: {{ $item->product_sku }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                        <td class="text-end">${{ number_format($item->total, 2) }}</td>
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
                                    <td class="text-end fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-geo-alt me-2"></i>Shipping Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Shipping Address</h6>
                            <address class="mb-4">
                                {!! nl2br(e($order->shipping_address ?? 'No shipping address provided')) !!}
                            </address>
                        </div>
                        <div class="col-md-6">
                            <h6>Billing Address</h6>
                            <address class="mb-4">
                                {!! nl2br(e($order->billing_address ?? 'No billing address provided')) !!}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Shipping Method</h6>
                            <p>{{ ucwords(str_replace('_', ' ', $order->shipping_method ?? 'Not Specified')) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Tracking Number</h6>
                            <p>{{ $order->tracking_number ?? 'Not Available' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($order->notes)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-sticky me-2"></i>Order Notes
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{!! nl2br(e($order->notes)) !!}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Customer Information -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-person me-2"></i>Customer Information
                    </h5>
                </div>
                <div class="card-body">
                    @if($order->user)
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-person fs-4 text-muted"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $order->user->name }}</h5>
                                <p class="text-muted mb-0">{{ $order->user->email }}</p>
                            </div>
                        </div>

                        @if($order->user->phone)
                            <div class="mb-3">
                                <h6>Phone</h6>
                                <p class="mb-0">{{ $order->user->phone }}</p>
                            </div>
                        @endif

                        <div class="mb-0">
                            <h6>Customer Since</h6>
                            <p class="mb-0">{{ $order->user->created_at->format('F d, Y') }}</p>
                        </div>

                        <hr>

                        <div class="d-grid">
                            <a href="{{ route('admin.customer.edit', $order->user->id) }}" class="btn btn-outline-primary">
                                <i class="bi bi-person-gear me-2"></i>Manage Customer
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-person-x fs-1 text-muted mb-3"></i>
                            <h6 class="text-muted">Customer Not Found</h6>
                            <p class="text-muted mb-0">This order is not associated with any customer account.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>Order Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled timeline">
                        <li class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Order Created</h6>
                                <p class="text-muted mb-0 small">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </li>

                        @if($order->status != 'pending')
                            <li class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Status Updated to {{ ucfirst($order->status) }}</h6>
                                    <p class="text-muted mb-0 small">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </li>
                        @endif

                        @if($order->payment_status == 'paid')
                            <li class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Payment Received</h6>
                                    <p class="text-muted mb-0 small">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-gear me-2"></i>Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil me-2"></i>Edit Order
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="deleteOrder({{ $order->id }})">
                            <i class="bi bi-trash me-2"></i>Delete Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this order? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Order</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    margin-top: 5px;
}

.timeline:before {
    content: '';
    position: absolute;
    left: -23px;
    top: 0;
    height: 100%;
    width: 2px;
    background-color: #e9ecef;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Show success message if redirected
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif

    // Order status update
    $('.status-update').on('click', function(e) {
        e.preventDefault();

        const status = $(this).data('status');
        const orderId = $(this).data('order-id');

        updateOrderStatus(orderId, status);
    });

    // Payment status update
    $('.payment-status-update').on('click', function(e) {
        e.preventDefault();

        const status = $(this).data('status');
        const orderId = $(this).data('order-id');

        updatePaymentStatus(orderId, status);
    });
});

function updateOrderStatus(orderId, status) {
    $.ajax({
        url: `/admin/order/${orderId}/status`,
        method: 'POST',
        data: { status: status },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            showToast('Order status updated successfully!', 'success');
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        error: function() {
            showToast('Failed to update order status. Please try again.', 'danger');
        }
    });
}

function updatePaymentStatus(orderId, status) {
    $.ajax({
        url: `/admin/order/${orderId}/payment-status`,
        method: 'POST',
        data: { payment_status: status },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            showToast('Payment status updated successfully!', 'success');
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        error: function() {
            showToast('Failed to update payment status. Please try again.', 'danger');
        }
    });
}

function deleteOrder(orderId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();

    $('#confirmDelete').on('click', function() {
        // Show loading
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...');

        // Send delete request
        $.ajax({
            url: `/admin/order/delete/${orderId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showToast('Order deleted successfully!', 'success');
                setTimeout(() => {
                    window.location.href = "{{ route('admin.order.index') }}";
                }, 1000);
            },
            error: function() {
                showToast('Failed to delete order. Please try again.', 'danger');
                $('#confirmDelete').prop('disabled', false).html('Delete Order');
            }
        });
    });
}
</script>
@endpush
