@extends('layouts.app')

@section('title', 'Products - Nexwear')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 mb-3">Our Products</h1>
            <p class="lead text-muted">Discover our collection of premium products</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('customer.products.index') }}" method="GET" id="filterForm">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0"
                                           id="productSearch" name="search" placeholder="Search products..."
                                           value="{{ $search ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="sortBy" name="sort">
                                    <option value="newest" {{ ($sortBy ?? '') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="price_asc" {{ ($sortBy ?? '') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ ($sortBy ?? '') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name_asc" {{ ($sortBy ?? '') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                    <option value="name_desc" {{ ($sortBy ?? '') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary" onclick="toggleView('grid')" id="gridBtn" type="button">
                                        <i class="bi bi-grid-3x3-gap"></i>
                                    </button>
                                    <button class="btn btn-outline-primary" onclick="toggleView('list')" id="listBtn" type="button">
                                        <i class="bi bi-list-ul"></i>
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-funnel me-1"></i>Filter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="priceRange" class="form-label">Price Range</label>
                                <select class="form-select" id="priceRange" name="price_range">
                                    <option value="">All Prices</option>
                                    <option value="0-50" {{ ($priceRange ?? '') == '0-50' ? 'selected' : '' }}>$0 - $50</option>
                                    <option value="50-100" {{ ($priceRange ?? '') == '50-100' ? 'selected' : '' }}>$50 - $100</option>
                                    <option value="100-200" {{ ($priceRange ?? '') == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                                    <option value="200-500" {{ ($priceRange ?? '') == '200-500' ? 'selected' : '' }}>$200 - $500</option>
                                    <option value="500-1000" {{ ($priceRange ?? '') == '500-1000' ? 'selected' : '' }}>$500 - $1000</option>
                                    <option value="1000-10000" {{ ($priceRange ?? '') == '1000-10000' ? 'selected' : '' }}>$1000+</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    @if(isset($featuredProducts) && $featuredProducts->count() > 0 && !$search)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="bi bi-star-fill text-warning me-2"></i>Featured Products
            </h3>
            <div class="row">
                @foreach($featuredProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 product-card-featured">
                        <div class="position-relative">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/images/' . $product->thumbnail) }}"
                                     class="card-img-top" alt="{{ $product->name }}"
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="bi bi-box text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            </span>
                            @if($product->isOnSale())
                                <span class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-danger">
                                        Sale
                                    </span>
                                </span>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit($product->short_description ?? 'No description available', 80) }}
                            </p>
                            <div class="mb-3">
                                @if($product->isOnSale())
                                    <span class="text-decoration-line-through text-muted me-2">${{ number_format($product->price, 2) }}</span>
                                    <span class="h5 text-danger">${{ number_format($product->sale_price, 2) }}</span>
                                @else
                                    <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('customer.products.show', $product) }}"
                               class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- New Arrivals Section -->
    @if(isset($newArrivals) && $newArrivals->count() > 0 && !$search)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="bi bi-box-seam text-success me-2"></i>New Arrivals
            </h3>
            <div class="row">
                @foreach($newArrivals as $product)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 product-card">
                        <div class="position-relative">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/images/' . $product->thumbnail) }}"
                                     class="card-img-top" alt="{{ $product->name }}"
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="bi bi-box text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-success">
                                    <i class="bi bi-box-seam"></i> New
                                </span>
                            </span>
                            @if($product->isOnSale())
                                <span class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-danger">
                                        Sale
                                    </span>
                                </span>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit($product->short_description ?? 'No description available', 80) }}
                            </p>
                            <div class="mb-3">
                                @if($product->isOnSale())
                                    <span class="text-decoration-line-through text-muted me-2">${{ number_format($product->price, 2) }}</span>
                                    <span class="h5 text-danger">${{ number_format($product->sale_price, 2) }}</span>
                                @else
                                    <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('customer.products.show', $product) }}"
                               class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Products Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-4">
                @if($search)
                    Search Results for "{{ $search }}"
                @else
                    All Products
                @endif
            </h3>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="row">
        @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item"
             data-name="{{ strtolower($product->name) }}"
             data-price="{{ $product->getCurrentPrice() }}">
            <div class="card border-0 shadow-sm h-100 product-card">
                <div class="position-relative">
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/images/' . $product->thumbnail) }}"
                             class="card-img-top" alt="{{ $product->name }}"
                             style="height: 180px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 180px;">
                            <i class="bi bi-box text-muted" style="font-size: 2.5rem;"></i>
                        </div>
                    @endif
                    @if($product->featured)
                        <span class="position-absolute top-0 end-0 m-2">
                            <i class="bi bi-star-fill text-warning fs-5"></i>
                        </span>
                    @endif
                    @if($product->isOnSale())
                        <span class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-danger">
                                Sale
                            </span>
                        </span>
                    @endif
                </div>
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <p class="card-text text-muted small">
                        {{ Str::limit($product->short_description ?? 'No description available', 60) }}
                    </p>
                    <div class="mb-3">
                        @if($product->isOnSale())
                            <span class="text-decoration-line-through text-muted me-2">${{ number_format($product->price, 2) }}</span>
                            <span class="h6 text-danger">${{ number_format($product->sale_price, 2) }}</span>
                        @else
                            <span class="h6 text-primary">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('customer.products.show', $product) }}"
                           class="btn btn-outline-primary btn-sm">
                            View Details
                        </a>
                        <button class="btn btn-primary btn-sm">
                            <i class="bi bi-bag-plus me-1"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-box text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Products Found</h4>
                <p class="text-muted">Try adjusting your search or filter to find what you're looking for.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- List View -->
    <div id="listView" class="d-none">
        @forelse($products as $product)
        <div class="card border-0 shadow-sm mb-3 product-item"
             data-name="{{ strtolower($product->name) }}"
             data-price="{{ $product->getCurrentPrice() }}">
            <div class="row g-0">
                <div class="col-md-3">
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/images/' . $product->thumbnail) }}"
                             class="img-fluid rounded-start h-100" alt="{{ $product->name }}"
                             style="object-fit: cover; min-height: 150px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-start h-100"
                             style="min-height: 150px;">
                            <i class="bi bi-box text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title">
                                    {{ $product->name }}
                                    @if($product->featured)
                                        <i class="bi bi-star-fill text-warning ms-2"></i>
                                    @endif
                                </h5>
                                <p class="card-text">{{ $product->short_description ?? 'No description available.' }}</p>

                                <div class="mb-3">
                                    @if($product->isOnSale())
                                        <span class="text-decoration-line-through text-muted me-2">${{ number_format($product->price, 2) }}</span>
                                        <span class="h5 text-danger">${{ number_format($product->sale_price, 2) }}</span>
                                    @else
                                        <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="bi bi-tag me-1"></i>{{ $product->category->name ?? 'Uncategorized' }}
                                    </small>
                                    <small class="text-muted ms-3">
                                        <i class="bi bi-award me-1"></i>{{ $product->brand->name ?? 'No Brand' }}
                                    </small>
                                </p>
                            </div>
                            <div class="ms-3 d-flex flex-column gap-2">
                                <a href="{{ route('customer.products.show', $product) }}"
                                   class="btn btn-outline-primary">
                                    View Details
                                </a>
                                <button class="btn btn-primary">
                                    <i class="bi bi-bag-plus me-1"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="bi bi-box text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No Products Found</h4>
            <p class="text-muted">Try adjusting your search or filter to find what you're looking for.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.product-card-featured {
    transition: all 0.3s ease;
    border-top: 3px solid #ffc107;
}

.product-card-featured:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

/* Custom Pagination Styling */
.pagination {
    margin-bottom: 0;
}

.pagination .page-item .page-link {
    color: #0d6efd;
    border-radius: 0.25rem;
    margin: 0 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.pagination .page-item .page-link:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}

/* Fix for pagination arrows */
.pagination svg {
    width: 20px;
    height: 20px;
    vertical-align: middle;
}
</style>
@endpush

@push('scripts')
<script>
let currentView = 'grid';

$(document).ready(function() {
    // Sort products
    $('#sortBy').on('change', function() {
        $('#filterForm').submit();
    });

    // Price range filter
    $('#priceRange').on('change', function() {
        $('#filterForm').submit();
    });
});

function toggleView(view) {
    currentView = view;

    if (view === 'grid') {
        $('#listView').addClass('d-none');
        $('#gridView').removeClass('d-none');
        $('#gridBtn').removeClass('btn-outline-primary').addClass('btn-primary');
        $('#listBtn').removeClass('btn-primary').addClass('btn-outline-primary');
    } else {
        $('#gridView').addClass('d-none');
        $('#listView').removeClass('d-none');
        $('#listBtn').removeClass('btn-outline-primary').addClass('btn-primary');
        $('#gridBtn').removeClass('btn-primary').addClass('btn-outline-primary');
    }
}
</script>
@endpush
