@extends('layouts.admin')

@section('title', 'Product Management - ShopZone')


@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Product Management</h1>
                    <p class="text-muted mb-0">Manage your products and their information</p>
                </div>
                <div>
                    <a href="/admin/product/create" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
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
                    <i class="bi bi-box-seam fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Total Products</h5>
                    <h2 class="text-primary">{{ $products->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-eye fs-1 text-success mb-3"></i>
                    <h5 class="card-title">Active Products</h5>
                    <h2 class="text-success">{{ $products->where('status', 1)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-star fs-1 text-warning mb-3"></i>
                    <h5 class="card-title">Featured</h5>
                    <h2 class="text-warning">{{ $products->where('featured', 1)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-currency-dollar fs-1 text-info mb-3"></i>
                    <h5 class="card-title">On Sale</h5>
                    <h2 class="text-info">{{ $products->filter(function($product) { return $product->sale_price && $product->sale_price < $product->price; })->count() }}</h2>
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
                        <div class="col-md-3">
                            <label class="form-label">Search Products</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search by name or SKU...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="categoryFilter">
                                <option value="">All Categories</option>
                                @foreach($products->pluck('category')->unique() as $category)
                                    @if($category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Brand</label>
                            <select class="form-select" id="brandFilter">
                                <option value="">All Brands</option>
                                @foreach($products->pluck('brand')->unique() as $brand)
                                    @if($brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Stock</label>
                            <select class="form-select" id="stockFilter">
                                <option value="">All Stock</option>
                                <option value="in">In Stock</option>
                                <option value="out">Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-secondary" onclick="clearFilters()">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-box-seam me-2"></i>Products List
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
                    @if($products->count() > 0)
                        <!-- Table View -->
                        <div id="tableView" class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th width="80">Image</th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th width="100">Status</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="productsTableBody">
                                    @foreach($products as $index => $product)
                                    <tr data-product-id="{{ $product->id }}" data-status="{{ $product->status }}" data-featured="{{ $product->featured }}" data-name="{{ strtolower($product->name) }}" data-sku="{{ strtolower($product->sku) }}" data-category="{{ $product->category_id }}" data-brand="{{ $product->brand_id }}" data-stock="{{ $product->stock_qty > 0 ? 'in' : 'out' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($product->thumbnail)
                                                <img src="{{ asset('storage/images/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}';">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-box-seam text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-1">{{ $product->name }}</h6>
                                                <small class="text-muted">{{ $product->slug }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                        <td>{{ $product->brand ? $product->brand->name : 'N/A' }}</td>
                                        <td>
                                            @if($product->sale_price && $product->sale_price < $product->price)
                                                <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                                                <span class="text-danger">${{ number_format($product->sale_price, 2) }}</span>
                                            @else
                                                <span>${{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock_qty > 0)
                                                <span class="badge bg-success">{{ $product->stock_qty }} in stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm gap-2" role="group">
                                                <button type="button" class="btn btn-outline-primary" onclick="viewProduct({{ $product->id }})" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-outline-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteProduct({{ $product->id }})" title="Delete">
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
                            <div class="row" id="productsGridBody">
                                @foreach($products as $product)
                                <div class="col-md-6 col-lg-4 mb-4 product-card" data-product-id="{{ $product->id }}" data-status="{{ $product->status }}" data-featured="{{ $product->featured }}" data-name="{{ strtolower($product->name) }}" data-sku="{{ strtolower($product->sku) }}" data-category="{{ $product->category_id }}" data-brand="{{ $product->brand_id }}" data-stock="{{ $product->stock_qty > 0 ? 'in' : 'out' }}">
                                    <div class="card h-100">
                                        <div class="position-relative">
                                            @if($product->thumbnail)
                                                <img src="{{ asset('storage/images/' . $product->thumbnail) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                    <i class="bi bi-box-seam text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                            @endif

                                            @if($product->featured)
                                                <span class="position-absolute top-0 end-0 m-2">
                                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                                </span>
                                            @endif

                                            <span class="position-absolute top-0 start-0 m-2">
                                                @if($product->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </span>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text text-muted small mb-1">SKU: {{ $product->sku }}</p>
                                            <div class="mb-2">
                                                <span class="badge bg-info me-1">{{ $product->category ? $product->category->name : 'No Category' }}</span>
                                                <span class="badge bg-secondary">{{ $product->brand ? $product->brand->name : 'No Brand' }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    @if($product->sale_price && $product->sale_price < $product->price)
                                                        <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                                                        <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                                                    @else
                                                        <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if($product->stock_qty > 0)
                                                        <span class="badge bg-success">{{ $product->stock_qty }} in stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group btn-group-sm gap-2">
                                                    <button type="button" class="btn btn-outline-primary" onclick="viewProduct({{ $product->id }})" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger" onclick="deleteProduct({{ $product->id }})" title="Delete">
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
                            <i class="bi bi-box-seam text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">No Products Found</h4>
                            <p class="text-muted">Start by creating your first product to sell in your store.</p>
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Create First Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Details Modal -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productModalBody">
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
                <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> Deleting a product will also remove all associated images and reviews.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Product</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentView = 'table';
let productToDelete = null;

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
        filterProducts();
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        filterProducts();
    });

    // Category filter
    $('#categoryFilter').on('change', function() {
        filterProducts();
    });

    // Brand filter
    $('#brandFilter').on('change', function() {
        filterProducts();
    });

    // Stock filter
    $('#stockFilter').on('change', function() {
        filterProducts();
    });
}

function filterProducts() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    const statusFilter = $('#statusFilter').val();
    const categoryFilter = $('#categoryFilter').val();
    const brandFilter = $('#brandFilter').val();
    const stockFilter = $('#stockFilter').val();

    if (currentView === 'table') {
        $('#productsTableBody tr').each(function() {
            const $row = $(this);
            const name = $row.data('name');
            const sku = $row.data('sku');
            const status = $row.data('status').toString();
            const category = $row.data('category').toString();
            const brand = $row.data('brand').toString();
            const stock = $row.data('stock');

            let show = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm) && !sku.includes(searchTerm)) {
                show = false;
            }

            // Status filter
            if (statusFilter && status !== statusFilter) {
                show = false;
            }

            // Category filter
            if (categoryFilter && category !== categoryFilter) {
                show = false;
            }

            // Brand filter
            if (brandFilter && brand !== brandFilter) {
                show = false;
            }

            // Stock filter
            if (stockFilter && stock !== stockFilter) {
                show = false;
            }

            $row.toggle(show);
        });
    } else {
        $('.product-card').each(function() {
            const $card = $(this);
            const name = $card.data('name');
            const sku = $card.data('sku');
            const status = $card.data('status').toString();
            const category = $card.data('category').toString();
            const brand = $card.data('brand').toString();
            const stock = $card.data('stock');

            let show = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm) && !sku.includes(searchTerm)) {
                show = false;
            }

            // Status filter
            if (statusFilter && status !== statusFilter) {
                show = false;
            }

            // Category filter
            if (categoryFilter && category !== categoryFilter) {
                show = false;
            }

            // Brand filter
            if (brandFilter && brand !== brandFilter) {
                show = false;
            }

            // Stock filter
            if (stockFilter && stock !== stockFilter) {
                show = false;
            }

            $card.toggle(show);
        });
    }
}

function clearFilters() {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    $('#categoryFilter').val('');
    $('#brandFilter').val('');
    $('#stockFilter').val('');
    filterProducts();
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
    filterProducts();
}

function viewProduct(productId) {
    // Show loading in modal
    $('#productModalBody').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading product details...</p>
        </div>
    `);

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();

    // Load product details via AJAX
    $.get(`/admin/product/${productId}`)
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
                                    <i class="bi bi-box-seam text-muted" style="font-size: 4rem;"></i>
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

                        <div class="mb-3">
                            <span class="badge bg-info me-1">${response.category ? response.category.name : 'No Category'}</span>
                            <span class="badge bg-secondary">${response.brand ? response.brand.name : 'No Brand'}</span>
                        </div>

                        <p class="text-muted mb-4">${response.short_description || 'No description available'}</p>

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Product Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">SKU</small>
                                    <span>${response.sku}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Price</small>
                                    <span>$${response.price}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Sale Price</small>
                                    <span>${response.sale_price ? '$' + response.sale_price : 'N/A'}</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Stock</small>
                                    <span>${response.stock_qty} units</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block">Weight</small>
                                    <span>${response.weight ? response.weight + ' kg' : 'N/A'}</span>
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

                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">Full Description</h5>
                            <div class="mt-2">
                                ${response.long_description || 'No detailed description available.'}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/admin/product/${response.id}/edit" class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>Edit Product
                            </a>
                            <button type="button" class="btn btn-danger" onclick="deleteProduct(${response.id})" data-bs-dismiss="modal">
                                <i class="bi bi-trash me-2"></i>Delete Product
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Update the modal content
            $('#productModalBody').html(html);
        })
        .fail(function() {
            $('#productModalBody').html(`
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Failed to load product details. Please try again.
                </div>
            `);
        });
}

function deleteProduct(productId) {
    productToDelete = productId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

$('#confirmDelete').on('click', function() {
    if (productToDelete) {
        // Show loading
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...');

        // Send delete request
        $.ajax({
            url: `/admin/product/delete/${productToDelete}`,
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: productToDelete
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                showToast('Product deleted successfully!', 'success');

                // Remove from table/grid
                $(`tr[data-product-id="${productToDelete}"], .product-card[data-product-id="${productToDelete}"]`).fadeOut(function() {
                    $(this).remove();
                });
            },
            error: function(xhr) {
                showToast('Failed to delete product. Please try again.', 'danger');
            }
        })
        .always(function() {
            $('#confirmDelete').prop('disabled', false).html('Delete Product');
            productToDelete = null;
        });
    }
});
</script>
@endpush
