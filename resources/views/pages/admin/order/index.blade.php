@extends('layouts.admin')

@section('title', 'Orders - Nexwear')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Orders</h1>
                    <p class="text-muted mb-0">Manage customer orders</p>
                </div>
                <div>
                    <a href="{{ route('admin.order.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Create New Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-cart fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Total Orders</h5>
                    <h2 class="text-primary">{{ $orders->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-hourglass-split fs-1 text-warning mb-3"></i>
                    <h5 class="card-title">Pending</h5>
                    <h2 class="text-warning">{{ $orders->where('status', 'pending')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-check-circle fs-1 text-success mb-3"></i>
                    <h5 class="card-title">Completed</h5>
                    <h2 class="text-success">{{ $orders->where('status', 'completed')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-currency-dollar fs-1 text-info mb-3"></i>
                    <h5 class="card-title">Total Revenue</h5>
                    <h2 class="text-info">${{ number_format($orders->sum('total_amount'), 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Search Orders</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search by order number or customer...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Order Status</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Payment Status</label>
                            <select class="form-select" id="paymentStatusFilter">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="failed">Failed</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date Range</label>
                            <select class="form-select" id="dateFilter">
                                <option value="">All Time</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-secondary" onclick="clearFilters()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-cart me-2"></i>Order List
                    </h5>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr data-order-id="{{ $order->id }}" data-order-number="{{ $order->order_number }}" data-customer="{{ strtolower($order->user->name ?? 'Unknown') }}" data-status="{{ $order->status }}" data-payment-status="{{ $order->payment_status }}" data-date="{{ $order->created_at->format('Y-m-d') }}">
                                        <td>
                                            <a href="{{ route('admin.order.show', $order->id) }}" class="fw-bold text-decoration-none">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td>{{ $order->user->name ?? 'Unknown' }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{
                                                $order->status == 'completed' ? 'success' :
                                                ($order->status == 'processing' ? 'info' :
                                                ($order->status == 'cancelled' ? 'danger' :
                                                ($order->status == 'refunded' ? 'secondary' : 'warning')))
                                            }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{
                                                $order->payment_status == 'paid' ? 'success' :
                                                ($order->payment_status == 'failed' ? 'danger' :
                                                ($order->payment_status == 'refunded' ? 'secondary' : 'warning'))
                                            }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm gap-2" role="group">
                                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-outline-primary" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-outline-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteOrder({{ $order->id }})" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">No Orders Found</h4>
                            <p class="text-muted">There are no orders in the system yet.</p>
                            <a href="{{ route('admin.order.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-2"></i>Create New Order
                            </a>
                        </div>
                    @endif
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

@push('scripts')
<script>
let orderToDelete = null;

$(document).ready(function() {
    // Initialize filters
    setupFilters();

    // Show success message if redirected
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
});

function setupFilters() {
    // Search functionality
    $('#searchInput').on('input', function() {
        filterOrders();
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        filterOrders();
    });

    // Payment status filter
    $('#paymentStatusFilter').on('change', function() {
        filterOrders();
    });

    // Date filter
    $('#dateFilter').on('change', function() {
        filterOrders();
    });
}

function filterOrders() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    const statusFilter = $('#statusFilter').val();
    const paymentStatusFilter = $('#paymentStatusFilter').val();
    const dateFilter = $('#dateFilter').val();

    // Get current date for date filtering
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);
    const weekStart = new Date(today);
    weekStart.setDate(today.getDate() - today.getDay());
    const monthStart = new Date(today.getFullYear(), today.getMonth(), 1);

    $('tbody tr').each(function() {
        const $row = $(this);
        const orderNumber = $row.data('order-number').toString().toLowerCase();
        const customer = $row.data('customer').toString().toLowerCase();
        const status = $row.data('status');
        const paymentStatus = $row.data('payment-status');
        const orderDate = new Date($row.data('date'));

        let show = true;

        // Search filter
        if (searchTerm && !orderNumber.includes(searchTerm) && !customer.includes(searchTerm)) {
            show = false;
        }

        // Status filter
        if (statusFilter && status !== statusFilter) {
            show = false;
        }

        // Payment status filter
        if (paymentStatusFilter && paymentStatus !== paymentStatusFilter) {
            show = false;
        }

        // Date filter
        if (dateFilter) {
            if (dateFilter === 'today' && orderDate.toDateString() !== today.toDateString()) {
                show = false;
            } else if (dateFilter === 'yesterday' && orderDate.toDateString() !== yesterday.toDateString()) {
                show = false;
            } else if (dateFilter === 'week' && orderDate < weekStart) {
                show = false;
            } else if (dateFilter === 'month' && orderDate < monthStart) {
                show = false;
            }
        }

        $row.toggle(show);
    });
}

function clearFilters() {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    $('#paymentStatusFilter').val('');
    $('#dateFilter').val('');
    filterOrders();
}

function deleteOrder(orderId) {
    orderToDelete = orderId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

$('#confirmDelete').on('click', function() {
    if (orderToDelete) {
        // Show loading
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...');

        // Send delete request
        $.ajax({
            url: `/admin/order/delete/${orderToDelete}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                showToast('Order deleted successfully!', 'success');

                // Remove from table
                $(`tr[data-order-id="${orderToDelete}"]`).fadeOut(function() {
                    $(this).remove();

                    // If no orders left, reload page to show empty state
                    if ($('tbody tr:visible').length === 0) {
                        location.reload();
                    }
                });
            },
            error: function() {
                showToast('Failed to delete order. Please try again.', 'danger');
            }
        })
        .always(function() {
            $('#confirmDelete').prop('disabled', false).html('Delete Order');
            orderToDelete = null;
        });
    }
});
</script>
@endpush
