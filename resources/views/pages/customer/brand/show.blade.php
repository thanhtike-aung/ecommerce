@extends('layouts.app')

@section('title', $brandWithProducts->name . ' - ShopZone')

@section('navigation')
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-shop text-primary"></i> ShopZone
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.brands.index') }}">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-heart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-bag"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-person"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.brands.index') }}">Brands</a></li>
            <li class="breadcrumb-item active">{{ $brandWithProducts->name }}</li>
        </ol>
    </nav>

    <!-- Brand Header -->
    <div class="row mb-5">
        <div class="col-md-4">
            @if($brandWithProducts->thumbnail)
                <img src="{{ asset('storage/' . $brandWithProducts->thumbnail) }}"
                     class="img-fluid rounded shadow" alt="{{ $brandWithProducts->name }}">
            @else
                <div class="bg-light rounded shadow d-flex align-items-center justify-content-center"
                     style="height: 300px;">
                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-3">
                <h1 class="display-4 mb-0">{{ $brandWithProducts->name }}</h1>
                @if($brandWithProducts->featured)
                    <span class="badge bg-warning ms-3">
                        <i class="bi bi-star-fill"></i> Featured
                    </span>
                @endif
            </div>

            @if($brandWithProducts->description)
                <p class="lead text-muted mb-4">{{ $brandWithProducts->description }}</p>
            @endif

            <div class="row">
                <div class="col-sm-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center">
                            <h3 class="text-primary">{{ $brandWithProducts->products->count() }}</h3>
                            <p class="mb-0 text-muted">Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center">
                            <h3 class="text-success">{{ $brandWithProducts->products->where('status', 1)->count() }}</h3>
                            <p class="mb-0 text-muted">Active Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Products by {{ $brandWithProducts->name }}</h3>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" id="sortProducts" style="width: auto;">
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                        <option value="price_asc">Price (Low to High)</option>
                        <option value="price_desc">Price (High to Low)</option>
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

    @if($brandWithProducts->products->count() > 0)
        <!-- Products Grid View -->
        <div id="productsGridView" class="row">
            @foreach($brandWithProducts->products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 product-item"
                 data-name="{{ strtolower($product->name) }}"
                 data-price="{{ $product->price ?? 0 }}">
                <div class="card border-0 shadow-sm h-100 product-card">
                    <div class="position-relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="card-img-top" alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                <i class="bi bi-box text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif

                        @if($product->status)
                            <span class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-success">Available</span>
                            </span>
                        @else
                            <span class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-secondary">Out of Stock</span>
                            </span>
                        @endif
                    </div>

                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text text-muted small">
                            {{ Str::limit($product->description ?? 'No description available', 80) }}
                        </p>

                        @if($product->price)
                            <div class="mb-3">
                                <span class="h5 text-primary">${{ number_format($product->price, 2) }}</span>
                            </div>
                        @endif

                        <div class="d-grid">
                            @if($product->status)
                                <button class="btn btn-primary btn-sm">
                                    <i class="bi bi-bag-plus me-1"></i>Add to Cart
                                </button>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Products List View -->
        <div id="productsListView" class="d-none">
            @foreach($brandWithProducts->products as $product)
            <div class="card border-0 shadow-sm mb-3 product-item"
                 data-name="{{ strtolower($product->name) }}"
                 data-price="{{ $product->price ?? 0 }}">
                <div class="row g-0">
                    <div class="col-md-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
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
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description ?? 'No description available.' }}</p>

                                    @if($product->price)
                                        <p class="card-text">
                                            <span class="h4 text-primary">${{ number_format($product->price, 2) }}</span>
                                        </p>
                                    @endif

                                    <p class="card-text">
                                        @if($product->status)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-secondary">Out of Stock</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="ms-3">
                                    @if($product->status)
                                        <button class="btn btn-primary">
                                            <i class="bi bi-bag-plus me-1"></i>Add to Cart
                                        </button>
                                    @else
                                        <button class="btn btn-secondary" disabled>
                                            Out of Stock
                                        </button>
                                    @endif
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
            <p class="text-muted">This brand doesn't have any products yet. Check back soon!</p>
            <a href="{{ route('customer.brands.index') }}" class="btn btn-primary">
                Browse Other Brands
            </a>
        </div>
    @endif
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
        const aPrice = parseFloat($(a).data('price')) || 0;
        const bPrice = parseFloat($(b).data('price')) || 0;

        switch(sortBy) {
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

    $.each($items, function(index, item) {
        $container.append(item);
    });
}
</script>
@endpush
