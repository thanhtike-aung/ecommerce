@extends('layouts.admin')

@section('title', 'Category Management - ShopZone')


@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Category Management</h1>
                    <p class="text-muted mb-0">Manage your product categories and their information</p>
                </div>
                <div>
                    <a href="/admin/category/create" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Category
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
                    <i class="bi bi-grid fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Total Categories</h5>
                    <h2 class="text-primary">{{ $categories->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-eye fs-1 text-success mb-3"></i>
                    <h5 class="card-title">Active Categories</h5>
                    <h2 class="text-success">{{ $categories->where('status', 1)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-star fs-1 text-warning mb-3"></i>
                    <h5 class="card-title">Featured</h5>
                    <h2 class="text-warning">{{ $categories->where('featured', 1)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-diagram-3 fs-1 text-info mb-3"></i>
                    <h5 class="card-title">Parent Categories</h5>
                    <h2 class="text-info">{{ $categories->whereNull('parent_id')->count() }}</h2>
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
                            <label class="form-label">Search Categories</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search by name or description...">
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
                            <label class="form-label">Type Filter</label>
                            <select class="form-select" id="typeFilter">
                                <option value="">All Categories</option>
                                <option value="parent">Parent Categories</option>
                                <option value="child">Child Categories</option>
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

    <!-- Categories List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-grid me-2"></i>Categories List
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary" onclick="toggleView('grid')">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </button>
                            <button class="btn btn-sm btn-primary" onclick="toggleView('table')">
                                <i class="bi bi-list-ul"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($categories->count() > 0)
                        <!-- Table View -->
                        <div id="tableView" class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th width="80">Image</th>
                                        <th>Category Name</th>
                                        <th>Parent</th>
                                        <th>Description</th>
                                        <th width="100">Status</th>
                                        <th width="100">Featured</th>
                                        <th width="120">Products</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="categoriesTableBody">
                                    @foreach($categories as $index => $category)
                                    <tr data-category-id="{{ $category->id }}" data-status="{{ $category->status }}" data-featured="{{ $category->featured }}" data-name="{{ strtolower($category->name) }}" data-description="{{ strtolower($category->description ?? '') }}" data-parent="{{ $category->parent_id ? 'child' : 'parent' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($category->thumbnail)
                                                <img src="{{ asset('/storage/images/' . $category->thumbnail) }}" alt="{{ $category->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-grid text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-1">{{ $category->name }}</h6>
                                                <small class="text-muted">{{ $category->slug }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($category->parent)
                                                <span class="badge bg-info">{{ $category->parent->name }}</span>
                                            @else
                                                <span class="badge bg-secondary">None</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $category->description }}">
                                                {{ $category->description ?? 'No description available' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($category->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->featured)
                                                <i class="bi bi-star-fill text-warning" title="Featured"></i>
                                            @else
                                                <i class="bi bi-star text-muted" title="Not Featured"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $category->products->count() }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm gap-2" role="group">
                                                <button type="button" class="btn btn-outline-primary" onclick="viewCategory({{ $category->id }})" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-outline-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteCategory({{ $category->id }})" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Grid View -->
                        <div id="gridView" class="d-none">
                            <div class="row" id="categoriesGridBody">
                                @foreach($categories as $category)
                                <div class="col-md-6 col-lg-4 mb-4 category-card" data-category-id="{{ $category->id }}" data-status="{{ $category->status }}" data-featured="{{ $category->featured }}" data-name="{{ strtolower($category->name) }}" data-description="{{ strtolower($category->description ?? '') }}" data-parent="{{ $category->parent_id ? 'child' : 'parent' }}">
                                    <div class="card h-100">
                                        <div class="position-relative">
                                            @if($category->thumbnail)
                                                <img src="{{ asset('storage/images/' . $category->thumbnail) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                    <i class="bi bi-grid text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                            @endif

                                            @if($category->featured)
                                                <span class="position-absolute top-0 end-0 m-2">
                                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                                </span>
                                            @endif

                                            <span class="position-absolute top-0 start-0 m-2">
                                                @if($category->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </span>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $category->name }}</h5>
                                            @if($category->parent)
                                                <div class="mb-2">
                                                    <span class="badge bg-info">{{ $category->parent->name }}</span>
                                                </div>
                                            @endif
                                            <p class="card-text text-muted small">{{ $category->description ?? 'No description available' }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="bi bi-box-seam me-1"></i>{{ $category->products->count() }} Products
                                                </small>
                                                <div class="btn-group btn-group-sm gap-2">
                                                    <button type="button" class="btn btn-outline-primary" onclick="viewCategory({{ $category->id }})" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger" onclick="deleteCategory({{ $category->id }})" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <i class="bi bi-grid text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">No Categories Found</h4>
                            <p class="text-muted">Start by creating your first category to organize your products.</p>
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Create First Category
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Details Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="categoryModalBody">
                <!-- Content will be loaded here -->
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
                <p>Are you sure you want to delete this category? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> Deleting a parent category may affect its child categories.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Category</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentView = 'table';
let categoryToDelete = null;

$(document).ready(function() {
    // Initialize filters
    setupFilters();

    // Show success message if redirected from create/update
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
});

function setupFilters() {
    // Search functionality
    $('#searchInput').on('input', function() {
        filterCategories();
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        filterCategories();
    });

    // Type filter
    $('#typeFilter').on('change', function() {
        filterCategories();
    });
}

function filterCategories() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    const statusFilter = $('#statusFilter').val();
    const typeFilter = $('#typeFilter').val();

    if (currentView === 'table') {
        $('#categoriesTableBody tr').each(function() {
            const $row = $(this);
            const name = $row.data('name');
            const description = $row.data('description');
            const status = $row.data('status').toString();
            const parent = $row.data('parent');

            let show = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm) && !description.includes(searchTerm)) {
                show = false;
            }

            // Status filter
            if (statusFilter && status !== statusFilter) {
                show = false;
            }

            // Type filter
            if (typeFilter && parent !== typeFilter) {
                show = false;
            }

            $row.toggle(show);
        });
    } else {
        $('.category-card').each(function() {
            const $card = $(this);
            const name = $card.data('name');
            const description = $card.data('description');
            const status = $card.data('status').toString();
            const parent = $card.data('parent');

            let show = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm) && !description.includes(searchTerm)) {
                show = false;
            }

            // Status filter
            if (statusFilter && status !== statusFilter) {
                show = false;
            }

            // Type filter
            if (typeFilter && parent !== typeFilter) {
                show = false;
            }

            $card.toggle(show);
        });
    }
}

function clearFilters() {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    $('#typeFilter').val('');
    filterCategories();
}

function toggleView(view) {
    currentView = view;

    if (view === 'grid') {
        $('#tableView').addClass('d-none');
        $('#gridView').removeClass('d-none');
        $('button[onclick="toggleView(\'grid\')"]').removeClass('btn-outline-primary').addClass('btn-primary');
        $('button[onclick="toggleView(\'table\')"]').removeClass('btn-primary').addClass('btn-outline-primary');
    } else {
        $('#gridView').addClass('d-none');
        $('#tableView').removeClass('d-none');
        $('button[onclick="toggleView(\'table\')"]').removeClass('btn-outline-primary').addClass('btn-primary');
        $('button[onclick="toggleView(\'grid\')"]').removeClass('btn-primary').addClass('btn-outline-primary');
    }

    // Reapply filters
    filterCategories();
}

function viewCategory(categoryId) {
    // Show loading in modal
    $('#categoryModalBody').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading category details...</p>
        </div>
    `);

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
    modal.show();

    // Load category details via AJAX
    $.get(`/admin/category/${categoryId}`)
        .done(function(response) {
            // Format the created_at and updated_at dates
            const createdDate = new Date(response.created_at).toLocaleString();
            const updatedDate = new Date(response.updated_at).toLocaleString();

            // Build the HTML content for the modal
            let html = `
                <div class="row">
                    <div class="col-md-5">
                        <div class="text-center mb-4">
                            ${response.thumbnail
                                ? `<img src="/storage/images/${response.thumbnail}" class="img-fluid rounded" alt="${response.name}" style="max-height: 250px;">`
                                : `<div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="bi bi-grid text-muted" style="font-size: 4rem;"></i>
                                  </div>`
                            }
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3>${response.name}</h3>
                            <div>
                                ${response.status == 1
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>'
                                }
                                ${response.featured == 1
                                    ? '<span class="badge bg-warning ms-2">Featured</span>'
                                    : ''
                                }
                            </div>
                        </div>

                        <p class="text-muted mb-4">${response.description || 'No description available'}</p>

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Category Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Slug</small>
                                    <span>${response.slug}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Parent Category</small>
                                    <span>${response.parent ? response.parent.name : 'None'}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Products</small>
                                    <span>${response.products ? response.products.length : 0} products</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Child Categories</small>
                                    <span>${response.children ? response.children.length : 0} subcategories</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Created</small>
                                    <span>${createdDate}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Last Updated</small>
                                    <span>${updatedDate}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Update the modal content
            $('#categoryModalBody').html(html);
        })
        .fail(function() {
            $('#categoryModalBody').html(`
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Failed to load category details. Please try again.
                </div>
            `);
        });
}

function deleteCategory(categoryId) {
    categoryToDelete = categoryId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

$('#confirmDelete').on('click', function() {
    if (categoryToDelete) {
        // Show loading
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...');

        // Send delete request
        $.ajax({
            url: `/admin/category/delete/${categoryToDelete}`,
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: categoryToDelete
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                showToast('Category deleted successfully!', 'success');

                // Remove from table/grid
                $(`tr[data-category-id="${categoryToDelete}"], .category-card[data-category-id="${categoryToDelete}"]`).fadeOut(function() {
                    $(this).remove();
                });
            },
            error: function(xhr) {
                showToast('Failed to delete category. Please try again.', 'danger');
            }
        })
        .always(function() {
            $('#confirmDelete').prop('disabled', false).html('Delete Category');
            categoryToDelete = null;
        });
    }
});
</script>
@endpush
