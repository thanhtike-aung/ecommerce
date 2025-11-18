@extends('layouts.app')

@section('title', 'Brands - ShopZone')

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
                    <a class="nav-link active" href="{{ route('customer.brands.index') }}">Brands</a>
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
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 mb-3">Our Brands</h1>
            <p class="lead text-muted">Discover premium brands and their amazing products</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0"
                                       id="brandSearch" placeholder="Search brands...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="featuredFilter">
                                <option value="">All Brands</option>
                                <option value="1">Featured Only</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary" onclick="toggleView('grid')" id="gridBtn">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </button>
                                <button class="btn btn-primary" onclick="toggleView('list')" id="listBtn">
                                    <i class="bi bi-list-ul"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Brands Section -->
    @if($brands->where('featured', 1)->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="bi bi-star-fill text-warning me-2"></i>Featured Brands
            </h3>
            <div class="row">
                @foreach($brands->where('featured', 1)->take(4) as $brand)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 brand-card-featured">
                        <div class="position-relative">
                            @if($brand->thumbnail)
                                <img src="{{ asset($brand->thumbnail) }}"
                                     class="card-img-top" alt="{{ $brand->name }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            </span>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $brand->name }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit($brand->description ?? 'Discover amazing products', 80) }}
                            </p>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="bi bi-box-seam me-1"></i>{{ $brand->products_count ?? 0 }} Products
                                </small>
                            </div>
                            <a href="{{ route('customer.brands.show', $brand) }}"
                               class="btn btn-primary btn-sm">
                                View Products
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Brands Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-4">All Brands</h3>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="row">
        @forelse($brands as $brand)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 brand-item"
             data-name="{{ strtolower($brand->name) }}"
             data-featured="{{ $brand->featured }}">
            <div class="card border-0 shadow-sm h-100 brand-card">
                <div class="position-relative">
                    @if($brand->thumbnail)
                        <img src="{{ asset($brand->thumbnail) }}"
                             class="card-img-top" alt="{{ $brand->name }}"
                             style="height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 180px;">
                            <i class="bi bi-image text-muted" style="font-size: 2.5rem;"></i>
                        </div>
                    @endif
                    @if($brand->featured)
                        <span class="position-absolute top-0 end-0 m-2">
                            <i class="bi bi-star-fill text-warning fs-5"></i>
                        </span>
                    @endif
                </div>
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $brand->name }}</h6>
                    <p class="card-text text-muted small">
                        {{ Str::limit($brand->description ?? 'Discover amazing products', 60) }}
                    </p>
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="bi bi-box-seam me-1"></i>{{ $brand->products_count ?? 0 }} Products
                        </small>
                    </div>
                    <a href="{{ route('customer.brands.show', $brand) }}"
                       class="btn btn-outline-primary btn-sm">
                        View Products
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-tags text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Brands Found</h4>
                <p class="text-muted">We're working on adding more brands. Check back soon!</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- List View -->
    <div id="listView" class="d-none">
        @forelse($brands as $brand)
        <div class="card border-0 shadow-sm mb-3 brand-item"
             data-name="{{ strtolower($brand->name) }}"
             data-featured="{{ $brand->featured }}">
            <div class="row g-0">
                <div class="col-md-3">
                    @if($brand->thumbnail)
                        <img src="{{ asset($brand->thumbnail) }}"
                             class="img-fluid rounded-start h-100" alt="{{ $brand->name }}"
                             style="object-fit: cover; min-height: 150px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-start h-100"
                             style="min-height: 150px;">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">
                                    {{ $brand->name }}
                                    @if($brand->featured)
                                        <i class="bi bi-star-fill text-warning ms-2"></i>
                                    @endif
                                </h5>
                                <p class="card-text">{{ $brand->description ?? 'Discover amazing products from this brand.' }}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="bi bi-box-seam me-1"></i>{{ $brand->products_count ?? 0 }} Products Available
                                    </small>
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('customer.brands.show', $brand) }}"
                                   class="btn btn-primary">
                                    View Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="bi bi-tags text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No Brands Found</h4>
            <p class="text-muted">We're working on adding more brands. Check back soon!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.brand-card {
    transition: all 0.3s ease;
}

.brand-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.brand-card-featured {
    border: 2px solid #ffc107 !important;
}

.brand-card-featured:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(255, 193, 7, 0.3) !important;
}
</style>
@endpush

@push('scripts')
<script>
let currentView = 'grid';

$(document).ready(function() {
    // Search functionality
    $('#brandSearch').on('input', function() {
        filterBrands();
    });

    // Featured filter
    $('#featuredFilter').on('change', function() {
        filterBrands();
    });
});

function filterBrands() {
    const searchTerm = $('#brandSearch').val().toLowerCase();
    const featuredFilter = $('#featuredFilter').val();

    $('.brand-item').each(function() {
        const $item = $(this);
        const name = $item.data('name');
        const featured = $item.data('featured').toString();

        let show = true;

        // Search filter
        if (searchTerm && !name.includes(searchTerm)) {
            show = false;
        }

        // Featured filter
        if (featuredFilter && featured !== featuredFilter) {
            show = false;
        }

        $item.toggle(show);
    });
}

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
