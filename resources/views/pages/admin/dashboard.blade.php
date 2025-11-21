@extends('layouts.admin')

@section('title', 'Admin Dashboard')

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
                        <h3 class="mb-0">124</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-cart3 text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success me-2">+12%</span>
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
                        <h3 class="mb-0">$12,426</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-currency-dollar text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success me-2">+8%</span>
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
                        <h3 class="mb-0">85</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success me-2">+24%</span>
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
                        <h3 class="mb-0">248</h3>
                    </div>
                    <div class="bg-light-primary rounded-circle p-2">
                        <i class="bi bi-people text-primary fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success me-2">+18%</span>
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
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-001</td>
                                <td>John Doe</td>
                                <td>Nov 20, 2023</td>
                                <td>$125.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-002</td>
                                <td>Jane Smith</td>
                                <td>Nov 19, 2023</td>
                                <td>$245.99</td>
                                <td><span class="badge bg-warning text-dark">Processing</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-003</td>
                                <td>Robert Johnson</td>
                                <td>Nov 18, 2023</td>
                                <td>$82.50</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-004</td>
                                <td>Emily Wilson</td>
                                <td>Nov 18, 2023</td>
                                <td>$189.75</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-005</td>
                                <td>Michael Brown</td>
                                <td>Nov 17, 2023</td>
                                <td>$315.25</td>
                                <td><span class="badge bg-warning text-dark">Processing</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Top Selling Products</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width: 40px; height: 40px;"></div>
                            <div>
                                <h6 class="mb-0">Smartphone X Pro</h6>
                                <small class="text-muted">Electronics</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">42</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width: 40px; height: 40px;"></div>
                            <div>
                                <h6 class="mb-0">Wireless Earbuds</h6>
                                <small class="text-muted">Electronics</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">38</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width: 40px; height: 40px;"></div>
                            <div>
                                <h6 class="mb-0">Designer Watch</h6>
                                <small class="text-muted">Fashion</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">29</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width: 40px; height: 40px;"></div>
                            <div>
                                <h6 class="mb-0">Leather Backpack</h6>
                                <small class="text-muted">Fashion</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">24</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width: 40px; height: 40px;"></div>
                            <div>
                                <h6 class="mb-0">Smart Home Hub</h6>
                                <small class="text-muted">Electronics</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">19</span>
                    </li>
                </ul>
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
