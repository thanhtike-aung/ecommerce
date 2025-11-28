@extends('layouts.admin')

@section('title', 'Customers - ShopZone')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Customers</h1>
                    <p class="text-muted mb-0">Manage your customer accounts</p>
                </div>
                <div>
                    <a href="{{ route('admin.customer.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Add New Customer
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
                    <i class="bi bi-people fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Total Customers</h5>
                    <h2 class="text-primary">{{ $customers->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-person-check fs-1 text-success mb-3"></i>
                    <h5 class="card-title">Active</h5>
                    <h2 class="text-success">{{ $customers->where('status', 1)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-person-dash fs-1 text-warning mb-3"></i>
                    <h5 class="card-title">Inactive</h5>
                    <h2 class="text-warning">{{ $customers->where('status', 0)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-calendar-event fs-1 text-info mb-3"></i>
                    <h5 class="card-title">New This Month</h5>
                    <h2 class="text-info">{{ $customers->where('created_at', '>=', now()->startOfMonth())->count() }}</h2>
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
                        <div class="col-md-6">
                            <label class="form-label">Search Customers</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search by name, email or phone...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status Filter</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
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

    <!-- Customers Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-people me-2"></i>Customer List
                    </h5>
                </div>
                <div class="card-body">
                    @if($customers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th width="100">Status</th>
                                        <th width="120">Joined</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $index => $customer)
                                    <tr data-customer-id="{{ $customer->id }}" data-status="{{ $customer->status ?? 1 }}" data-name="{{ strtolower($customer->name) }}" data-email="{{ strtolower($customer->email) }}" data-phone="{{ $customer->phone ?? '' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person text-muted"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $customer->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if($customer->city && $customer->country)
                                                {{ $customer->city }}, {{ $customer->country }}
                                            @elseif($customer->city)
                                                {{ $customer->city }}
                                            @elseif($customer->country)
                                                {{ $customer->country }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $customer->status ? 'success' : 'warning' }}">
                                                {{ $customer->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $customer->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm gap-2" role="group">
                                                <button type="button" class="btn btn-outline-primary" onclick="viewCustomer({{ $customer->id }})" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-outline-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteCustomer({{ $customer->id }})" title="Delete">
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
                            <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">No Customers Found</h4>
                            <p class="text-muted">There are no customers in the system yet.</p>
                            <a href="{{ route('admin.customer.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-person-plus me-2"></i>Add New Customer
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Customer Details Modal -->
<div class="modal fade" id="customerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="customerModalBody">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="editCustomerBtn" class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
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
                <p>Are you sure you want to delete this customer? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Customer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let customerToDelete = null;

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
        filterCustomers();
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        filterCustomers();
    });
}

function filterCustomers() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    const statusFilter = $('#statusFilter').val();

    $('tbody tr').each(function() {
        const $row = $(this);
        const name = $row.data('name');
        const email = $row.data('email');
        const phone = $row.data('phone');
        const status = $row.data('status').toString();

        let show = true;

        // Search filter
        if (searchTerm && !name.includes(searchTerm) && !email.includes(searchTerm) && !phone.includes(searchTerm)) {
            show = false;
        }

        // Status filter
        if (statusFilter && status !== statusFilter) {
            show = false;
        }

        $row.toggle(show);
    });
}

function clearFilters() {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    filterCustomers();
}

function viewCustomer(customerId) {
    $.ajax({
        url: `/admin/customer/${customerId}`,
        method: 'GET',
        success: function(customer) {
            // Build the HTML content for the modal
            let html = `
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>${customer.name}</h5>
                        <p class="mb-1">
                            <span class="badge bg-${customer.status ? 'success' : 'warning'}">
                                ${customer.status ? 'Active' : 'Inactive'}
                            </span>
                        </p>
                        <p class="text-muted small">Member since ${new Date(customer.created_at).toLocaleDateString()}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Contact Information</h6>
                        <p class="mb-1"><i class="bi bi-envelope me-2"></i>${customer.email}</p>
                        <p class="mb-1"><i class="bi bi-telephone me-2"></i>${customer.phone || 'Not provided'}</p>
                    </div>

                    <div class="col-md-6">
                        <h6 class="fw-bold">Address</h6>
                        <address>
                            ${customer.address || 'No address provided'}<br>
                            ${customer.city ? customer.city + (customer.state ? ', ' + customer.state : '') : ''}
                            ${customer.postal_code ? customer.postal_code : ''}<br>
                            ${customer.country || ''}
                        </address>
                    </div>
                </div>
            `;

            // Update the modal content
            $('#customerModalBody').html(html);

            // Update the edit button URL
            $('#editCustomerBtn').attr('href', `/admin/customer/${customerId}/edit`);

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('customerModal'));
            modal.show();
        },
        error: function() {
            showToast('Failed to load customer details. Please try again.', 'danger');
        }
    });
}

function deleteCustomer(customerId) {
    customerToDelete = customerId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

$('#confirmDelete').on('click', function() {
    if (customerToDelete) {
        // Show loading
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...');

        // Send delete request
        $.ajax({
            url: `/admin/customer/delete/${customerToDelete}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                showToast('Customer deleted successfully!', 'success');

                // Remove from table
                $(`tr[data-customer-id="${customerToDelete}"]`).fadeOut(function() {
                    $(this).remove();

                    // If no customers left, reload page to show empty state
                    if ($('tbody tr:visible').length === 0) {
                        location.reload();
                    }
                });
            },
            error: function() {
                showToast('Failed to delete customer. Please try again.', 'danger');
            }
        })
        .always(function() {
            $('#confirmDelete').prop('disabled', false).html('Delete Customer');
            customerToDelete = null;
        });
    }
});
</script>
@endpush
