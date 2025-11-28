@extends('layouts.app')

@section('title', 'Categories - Nexwear')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 mb-3">Product Categories</h1>
            <p class="lead text-muted">Browse our products by category</p>
        </div>
    </div>

    <!-- Featured Categories Section -->
    @if(isset($featuredCategories) && $featuredCategories->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="bi bi-star-fill text-warning me-2"></i>Featured Categories
            </h3>
            <div class="row">
                @foreach($featuredCategories as $category)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 category-card-featured">
                        <div class="position-relative">
                            @if($category->thumbnail)
                                <img src="{{ asset('storage/images/' . $category->thumbnail) }}"
                                     class="card-img-top" alt="{{ $category->name }}"
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="bi bi-grid text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            </span>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit($category->description ?? 'Explore our collection', 80) }}
                            </p>
                            <a href="{{ route('customer.categories.show', $category) }}"
                               class="btn btn-primary btn-sm">
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

    <!-- All Categories Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-4">All Categories</h3>
        </div>
    </div>

    <!-- Parent Categories with Children -->
    @forelse($parentCategories as $parentCategory)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $parentCategory->name }}</h4>
                <a href="{{ route('customer.categories.show', $parentCategory) }}" class="btn btn-outline-primary btn-sm">
                    View All
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if($parentCategory->children && $parentCategory->children->count() > 0)
                    @foreach($parentCategory->children as $childCategory)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card border-0 shadow-sm h-100 category-card">
                            <div class="position-relative">
                                @if($childCategory->thumbnail)
                                    <img src="{{ asset('storage/images/' . $childCategory->thumbnail) }}"
                                         class="card-img-top" alt="{{ $childCategory->name }}"
                                         style="height: 150px; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                         style="height: 150px;">
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
                                <h6 class="card-title">{{ $childCategory->name }}</h6>
                                <a href="{{ route('customer.categories.show', $childCategory) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    Browse Products
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p class="text-muted text-center">No subcategories available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <i class="bi bi-grid text-muted" style="font-size: 4rem;"></i>
        <h4 class="mt-3 text-muted">No Categories Found</h4>
        <p class="text-muted">We're working on adding more categories. Check back soon!</p>
    </div>
    @endforelse
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

.category-card-featured {
    transition: all 0.3s ease;
    border-top: 3px solid #ffc107;
}

.category-card-featured:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}
</style>
@endpush
