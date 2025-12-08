@extends('layouts.app')

@section('title', $productWithDetails->name . ' - Nexwear')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.products.index') }}">Products</a></li>
            @if($productWithDetails->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.products.by_category', $productWithDetails->category->id) }}">
                        {{ $productWithDetails->category->name }}
                    </a>
                </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $productWithDetails->name }}</li>
        </ol>
    </nav>

    <!-- Product Details -->
    <div class="row mb-5">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="position-relative">
                        @if($productWithDetails->thumbnail)
                            <img src="{{ asset('storage/images/' . $productWithDetails->thumbnail) }}"
                                 class="img-fluid" id="mainProductImage" alt="{{ $productWithDetails->name }}"
                                 style="width: 100%; height: 400px; object-fit: cover;"
                                 onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 400px;">
                                <i class="bi bi-box text-muted" style="font-size: 5rem;"></i>
                            </div>
                        @endif

                        @if($productWithDetails->featured)
                            <span class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-warning">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            </span>
                        @endif

                        @if($productWithDetails->isOnSale())
                            <span class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-danger">
                                    Sale
                                </span>
                            </span>
                        @endif
                    </div>

                    <!-- Thumbnail Images -->
                    @if($productWithDetails->images && $productWithDetails->images->count() > 0)
                        <div class="row mt-3 mb-3 justify-content-center images-container">
                            @if ($productWithDetails->thumbnail)
                                <div class="col-2 text-center">
                                    <img src="{{ asset('storage/images/' . $productWithDetails->thumbnail) }}"
                                         class="img-thumbnail product-thumbnail rounded-3" alt="{{ $productWithDetails->name }}"
                                         style="height: 80px; object-fit: cover; cursor: pointer;"
                                         onclick="changeMainImage('{{ asset('storage/images/' . $productWithDetails->thumbnail) }}', this)"
                                         onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                                </div>
                            @endif
                            @foreach($productWithDetails->images as $image)
                                <div class="col-2 text-center">
                                    <img src="{{ asset('storage/images/' . $image->image) }}"
                                         class="img-thumbnail product-thumbnail rounded-3"
                                         alt="{{ $productWithDetails->name }}"
                                         style="height: 80px; object-fit: cover; cursor: pointer;"
                                         onclick="changeMainImage('{{ asset('storage/images/' . $image->image) }}', this)">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h1 class="mb-3">{{ $productWithDetails->name }}</h1>

                    <div class="mb-4">
                        @if($productWithDetails->isOnSale())
                            <span class="text-decoration-line-through text-muted me-2 fs-4">${{ number_format($productWithDetails->price, 2) }}</span>
                            <span class="fs-2 text-danger fw-bold">${{ number_format($productWithDetails->sale_price, 2) }}</span>
                            <span class="badge bg-danger ms-2">
                                {{ round((($productWithDetails->price - $productWithDetails->sale_price) / $productWithDetails->price) * 100) }}% OFF
                            </span>
                        @else
                            <span class="fs-2 text-primary fw-bold">${{ number_format($productWithDetails->price, 2) }}</span>
                        @endif
                    </div>

                    <div class="mb-4">
                        <p class="text-muted">
                            {{ $productWithDetails->short_description }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>SKU:</strong> {{ $productWithDetails->sku ?? 'N/A' }}</p>
                                <p class="mb-1">
                                    <strong>Availability:</strong>
                                    @if($productWithDetails->isInStock())
                                        <span class="text-success">In Stock</span>
                                    @else
                                        <span class="text-danger">Out of Stock</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1">
                                    <strong>Category:</strong>
                                    @if($productWithDetails->category)
                                        <a href="{{ route('customer.products.by_category', $productWithDetails->category->id) }}">
                                            {{ $productWithDetails->category->name }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <p class="mb-1">
                                    <strong>Brand:</strong>
                                    @if($productWithDetails->brand)
                                        <a href="{{ route('customer.products.by_brand', $productWithDetails->brand->id) }}">
                                            {{ $productWithDetails->brand->name }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity and Add to Cart -->
                    <div class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">Quantity</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="{{ $productWithDetails->stock_qty }}">
                                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8 d-flex align-items-end">
                                <div class="d-grid gap-2 w-100">
                                    <button id="addToCartBtn" class="btn btn-primary" {{ !$productWithDetails->isInStock() ? 'disabled' : '' }}>
                                        <i class="bi bi-bag-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Actions -->
                    <div class="mb-4">
                        <div class="d-flex gap-3">
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-heart me-1"></i>Add to Wishlist
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-share me-1"></i>Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Description and Reviews Tabs -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab"
                                    aria-controls="description" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews" type="button" role="tab"
                                    aria-controls="reviews" aria-selected="false">
                                Reviews ({{ $productWithDetails->reviews->count() }})
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-4" id="productTabsContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="product-description">
                                {!! $productWithDetails->long_description ?? 'No detailed description available.' !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            @if($productWithDetails->reviews->count() > 0)
                                <div class="mb-4">
                                    <h5>Customer Reviews</h5>
                                    @foreach($productWithDetails->reviews as $review)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6>{{ $review->user->name ?? 'Anonymous' }}</h6>
                                                        <div class="text-warning mb-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $review->rating)
                                                                    <i class="bi bi-star-fill"></i>
                                                                @else
                                                                    <i class="bi bi-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                                </div>
                                                <p class="card-text">{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-chat-square-text text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-muted">No Reviews Yet</h5>
                                    <p class="text-muted">Be the first to review this product!</p>
                                </div>
                            @endif

                            <div class="mt-4">
                                <h5>Write a Review</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Rating</label>
                                        <div class="rating-stars">
                                            <i class="bi bi-star fs-4 rating-star" data-rating="1"></i>
                                            <i class="bi bi-star fs-4 rating-star" data-rating="2"></i>
                                            <i class="bi bi-star fs-4 rating-star" data-rating="3"></i>
                                            <i class="bi bi-star fs-4 rating-star" data-rating="4"></i>
                                            <i class="bi bi-star fs-4 rating-star" data-rating="5"></i>
                                            <input type="hidden" id="rating" name="rating" value="0">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Your Review</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">Related Products</h3>
            <div class="row">
                @foreach($relatedProducts as $product)
                <div class="col-md-3 mb-4">
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
                            <a href="{{ route('customer.products.show', $product) }}"
                               class="btn btn-outline-primary btn-sm">
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

.product-thumbnail {
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

.product-thumbnail:hover {
    border-color: #0d6efd;
}

.rating-stars {
    color: #aaa;
    cursor: pointer;
}

.rating-stars .bi-star-fill {
    color: #ffc107;
}

.product-description img {
    max-width: 100%;
    height: auto;
}
</style>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function changeMainImage(imageSrc, element) {
    $('.product-thumbnail').removeClass('border border-2 border-primary');
    $(element).addClass('border border-2 border-primary');
    $('#mainProductImage').attr('src', imageSrc);
}

function incrementQuantity() {
    const quantityInput = document.getElementById('quantity');
    const maxQuantity = parseInt(quantityInput.getAttribute('max'));
    let currentQuantity = parseInt(quantityInput.value);

    if (currentQuantity < maxQuantity) {
        quantityInput.value = currentQuantity + 1;
    }
}

function decrementQuantity() {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value);

    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

$(document).ready(function() {
    // Rating stars functionality
    $('.rating-star').on('click', function() {
        const rating = $(this).data('rating');
        $('#rating').val(rating);

        $('.rating-star').removeClass('bi-star-fill').addClass('bi-star');

        for (let i = 1; i <= rating; i++) {
            $(`.rating-star[data-rating="${i}"]`).removeClass('bi-star').addClass('bi-star-fill');
        }
    });

    // Hover effect for rating stars
    $('.rating-star').hover(
        function() {
            const rating = $(this).data('rating');

            for (let i = 1; i <= rating; i++) {
                $(`.rating-star[data-rating="${i}"]`).addClass('text-warning');
            }
        },
        function() {
            $('.rating-star').removeClass('text-warning');
        }
    );

    // Add to Cart functionality
    $('#addToCartBtn').on('click', function() {
        const productId = "{{ $productWithDetails->id }}";
        const quantity = parseInt($('#quantity').val());
        const button = $(this);

        // Disable button and show loading state
        button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...');

        $.ajax({
            url: '{{ route("customer.cart.add") }}',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Show success message
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Update cart count in navbar if it exists
                if ($('.cart-count').length) {
                    $('.cart-count').text(response.cart_count);
                } else {
                    // If cart count element doesn't exist, you might want to create it
                    const cartIcon = $('.bi-cart');
                    if (cartIcon.length) {
                        cartIcon.after('<span class="badge bg-danger rounded-pill cart-count">' + response.cart_count + '</span>');
                    }
                }

                // Reset button state
                button.prop('disabled', false).html('<i class="bi bi-bag-plus me-2"></i>Add to Cart');
            },
            error: function(xhr) {
                // Show error message
                let errorMessage = 'An error occurred while adding to cart.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error'
                });

                // Reset button state
                button.prop('disabled', false).html('<i class="bi bi-bag-plus me-2"></i>Add to Cart');
            }
        });
    });
});
</script>
@endpush
