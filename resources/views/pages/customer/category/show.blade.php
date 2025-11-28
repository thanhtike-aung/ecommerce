@extends('layouts.app')

@section('title', $categoryWithProducts->name . ' - Nexwear')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.categories.index') }}">Categories</a></li>
            @if($categoryWithProducts->parent)
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.categories.show', $categoryWithProducts->parent) }}">
                        {{ $categoryWithProducts->parent->name }}
                    </a>
                </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $categoryWithProducts->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body py-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-5 mb-3">{{ $categoryWithProducts->name }}</h1>
                            <p class="lead text-muted">
                                {{ $categoryWithProducts->description ?? 'Browse our collection of products in this category.' }}
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            @if($categoryWithProducts->thumbnail)
                                <img src="{{ asset('storage/images/' . $categoryWithProducts->thumbnail) }}"
                                     alt="{{ $categoryWithProducts->name }}"
                                     class="img-fluid rounded-circle"
                                     style="max-height: 150px; max-width: 150px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                            @else
                                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                     style="height: 150px; width: 150px;">
                                    <i class="bi bi-grid text-muted" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subcategories Section -->
    @if(isset($childCategories) && $childCategories->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">Subcategories</h3>
            <div class="row">
                @foreach($childCategories as $childCategory)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 category-card">
                        <div class="position-relative">
                            @if($childCategory->thumbnail)
                                <img src="{{ asset('storage/images/' . $childCategory->thumbnail) }}"
                                     class="card-img-top" alt="{{ $childCategory->name }}"
                                     style="height: 180px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 180px;">
                                    <i class="bi bi-grid text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                            @endif
                            @if($childCategory->featured)
                                <span class="position-absolute top-0 end-0 m-2">
                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                </span>
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $childCategory->name }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit($childCategory->description ?? 'Explore our collection', 60) }}
                            </p>
                            <a href="{{ route('customer.categories.show', $childCategory) }}"
                               class="btn btn-outline-primary btn-sm">
                                Browse Products
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Products Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Products in {{ $categoryWithProducts->name }}</h3>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" id="sortProducts" style="width: auto;">
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                        <option value="price_asc">Price (Low to High)</option>
                        <option value="price_desc">Price (High to Low)</option>
                        <option value="newest">Newest First</option>
                    </select>
                    <button class="btn btn-sm btn-outline-primary" onclick="toggleProductView('grid')" id="productGridBtn">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </button>
                    <button class="btn btn-sm btn-primary" onclick="toggleProductView('list')" id="productListBtn">
                        <i class="bi bi-list-ul"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if($categoryWithProducts->products->count() > 0)
        <!-- Products Grid View -->
        <div id="productsGridView" class="row">
            @foreach($categoryWithProducts->products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item"
                 data-name="{{ strtolower($product->name) }}"
                 data-price="{{ $product->getCurrentPrice() }}">
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

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-1">{{ Str::limit($product->short_description ?? 'No description available', 80) }}</p>
                        <div class="mb-3">
                            @if($product->isOnSale())
                                <span class="text-decoration-line-through text-muted me-2">${{ number_format($product->price, 2) }}</span>
                                <span class="h5 text-danger">${{ number_format($product->sale_price, 2) }}</span>
                            @else
                                <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('customer.products.show', $product) }}" class="btn btn-outline-primary btn-sm">
                                View Details
                            </a>
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-bag-plus me-1"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Products List View -->
        <div id="productsListView" class="d-none">
            @foreach($categoryWithProducts->products as $product)
            <div class="card border-0 shadow-sm mb-3 product-item"
                 data-name="{{ strtolower($product->name) }}"
                 data-price="{{ $product->getCurrentPrice() }}">
                <div class="row g-0">
                    <div class="col-md-3">
                        @if($product->thumbnail)
                            <img src="{{ asset('storage/images/' . $product->thumbnail) }}"
                                 class="img-fluid rounded-start h-100" alt="{{ $product->name }}"
                                 style="object-fit: cover; min-height: 150px;"
                                 onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
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
            @endforeach
        </div>
    @else
        <!-- No Products -->
        <div class="text-center py-5">
            <i class="bi bi-box text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No Products Available</h4>
            <p class="text-muted">This category doesn't have any products yet. Check back soon!</p>
            <a href="{{ route('customer.categories.index') }}" class="btn btn-primary">
                Browse Other Categories
            </a>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.category-card {
    transition: all 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}
</style>
@endpush

@push('scripts')
<script>
let currentProductView = 'grid';

$(document).ready(function() {
    // Sort products
    $('#sortProducts').on('change', function() {
        sortProducts();
    });
});

function toggleProductView(view) {
    currentProductView = view;

    if (view === 'grid') {
        $('#productsListView').addClass('d-none');
        $('#productsGridView').removeClass('d-none');
        $('#productGridBtn').removeClass('btn-outline-primary').addClass('btn-primary');
        $('#productListBtn').removeClass('btn-primary').addClass('btn-outline-primary');
    } else {
        $('#productsGridView').addClass('d-none');
        $('#productsListView').removeClass('d-none');
        $('#productListBtn').removeClass('btn-outline-primary').addClass('btn-primary');
        $('#productGridBtn').removeClass('btn-primary').addClass('btn-outline-primary');
    }
}

function sortProducts() {
    const sortBy = $('#sortProducts').val();
    const $container = currentProductView === 'grid' ? $('#productsGridView') : $('#productsListView');
    const $items = $container.find('.product-item').get();

    $items.sort(function(a, b) {
        const aName = $(a).data('name');
        const bName = $(b).data('name');
        const aPrice = parseFloat($(a).data('price'));
        const bPrice = parseFloat($(b).data('price'));

        switch (sortBy) {
            case 'name_asc':
                return aName.localeCompare(bName);
            case 'name_desc':
                return bName.localeCompare(aName);
            case 'price_asc':
                return aPrice - bPrice;
            case 'price_desc':
                return bPrice - aPrice;
            default:
                return 0;
        }
    });

    $.each($items, function(i, item) {
        $container.append(item);
    });
}
</script>
@endpush
