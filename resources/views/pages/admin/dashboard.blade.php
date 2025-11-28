@extends('layouts.admin')

@section('title', 'Admin Dashboard - Nexwear')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Welcome, {{ auth()->user() ? auth()->user()->name : 'Admin' }}</h4>
                <p class="text-muted">Here's what's happening with your store today.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Total Orders</h6>
                        <h3 class="mb-0">{{ $totalOrders }}</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-cart3 text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge {{ $orderGrowth >= 0 ? 'bg-success' : 'bg-danger' }} me-2">{{ $orderGrowth >= 0 ? '+' : '' }}{{ $orderGrowth }}%</span>
                    <small class="text-muted">Since last month</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Total Revenue</h6>
                        <h3 class="mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-currency-dollar text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge {{ $revenueGrowth >= 0 ? 'bg-success' : 'bg-danger' }} me-2">{{ $revenueGrowth >= 0 ? '+' : '' }}{{ $revenueGrowth }}%</span>
                    <small class="text-muted">Since last month</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Total Products</h6>
                        <h3 class="mb-0">{{ $totalProducts }}</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge {{ $productGrowth >= 0 ? 'bg-success' : 'bg-danger' }} me-2">{{ $productGrowth >= 0 ? '+' : '' }}{{ $productGrowth }}%</span>
                    <small class="text-muted">Since last month</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Total Customers</h6>
                        <h3 class="mb-0">{{ $totalCustomers }}</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge {{ $customerGrowth >= 0 ? 'bg-success' : 'bg-danger' }} me-2">{{ $customerGrowth >= 0 ? '+' : '' }}{{ $customerGrowth }}%</span>
                    <small class="text-muted">Since last month</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Orders</h5>
                <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge {{
                                        $order->status == 'completed' ? 'bg-success' :
                                        ($order->status == 'processing' ? 'bg-warning text-dark' :
                                        ($order->status == 'cancelled' ? 'bg-danger' : 'bg-secondary'))
                                    }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No orders found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Top Selling Products</h5>
                <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($topSellingProducts as $product)
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if($product->thumbnail)
                            <div class="me-3" style="width: 40px; height: 40px;">
                                <img src="{{ asset('storage/images/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            @else
                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-box-seam text-muted"></i>
                            </div>
                            @endif
                            <div>
                                <h6 class="mb-0"><a href="{{ route('admin.product.edit', $product->id) }}" class="text-decoration-none">{{ $product->name }}</a></h6>
                                <small class="text-muted">{{ $product->category ? $product->category->name : 'Uncategorized' }}</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $product->total_quantity }}</span>
                    </li>
                    @empty
                    <li class="list-group-item px-0 text-center">
                        <p class="mb-0">No products found</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle me-2"></i>Add Product
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.order.create') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-cart-plus me-2"></i>Create Order
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.customer.create') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-person-plus me-2"></i>Add Customer
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.settings.general') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
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
    // Show welcome message
    setTimeout(() => {
        showToast('Welcome to Nexwear Admin Dashboard!', 'success');
    }, 1000);
});
</script>
@endpush
