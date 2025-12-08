@extends('layouts.app')

@section('title', 'Shopping Cart - ')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
    </nav>

    <h1 class="mb-4">Shopping Cart</h1>

    @if($cart->items->count() > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col" width="100">Product</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" class="text-center">Price</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-center">Total</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->items as $item)
                                        <tr id="cart-item-{{ $item->id }}">
                                            <td>
                                                @if($item->product->thumbnail)
                                                    <img src="{{ asset('storage/images/' . $item->product->thumbnail) }}"
                                                         class="img-thumbnail" alt="{{ $item->product->name }}"
                                                         style="width: 80px; height: 80px; object-fit: cover;"
                                                         onerror="this.onerror=null; this.src='{{ asset('storage/images/default.png') }}'">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                                         style="width: 80px; height: 80px;">
                                                        <i class="bi bi-box text-muted" style="font-size: 2rem;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-1">
                                                    <a href="{{ route('customer.products.show', $item->product->id) }}" class="text-decoration-none">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    @if($item->product->brand)
                                                        Brand: {{ $item->product->brand->name }}
                                                    @endif
                                                    @if($item->product->category)
                                                        | Category: {{ $item->product->category->name }}
                                                    @endif
                                                </small>
                                            </td>
                                            <td class="text-center">${{ number_format($item->price, 2) }}</td>
                                            <td class="text-center">
                                                <div class="input-group input-group-sm" style="width: 120px;">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="updateCartItemQuantity({{ $item->id }}, 'decrease')">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <input type="number" class="form-control text-center item-quantity"
                                                           value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_qty }}"
                                                           data-item-id="{{ $item->id }}">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="updateCartItemQuantity({{ $item->id }}, 'increase')">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="text-center item-total">${{ number_format($item->total, 2) }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-danger"
                                                        onclick="removeCartItem({{ $item->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <a href="{{ route('customer.products.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <button class="btn btn-outline-danger" onclick="clearCart()">
                        <i class="bi bi-trash me-2"></i>Clear Cart
                    </button>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal:</span>
                            <span id="cart-subtotal">${{ number_format($cart->total_price, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong id="cart-total">${{ number_format($cart->total_price, 2) }}</strong>
                        </div>
                        <div class="d-grid">
                            @auth
                                <a href="{{ route('customer.checkout.index') }}" class="btn btn-primary">
                                    <i class="bi bi-lock me-2"></i>Proceed to Checkout
                                </a>
                            @else
                                <a href="{{ route('customer.login') }}" class="btn btn-primary">
                                    <i class="bi bi-person me-2"></i>Login to Checkout
                                </a>
                                <small class="text-muted mt-2 text-center">You need to be logged in to checkout</small>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 5rem;"></i>
                <h3 class="mt-4 mb-3">Your cart is empty</h3>
                <p class="text-muted mb-4">Looks like you haven't added any products to your cart yet.</p>
                <a href="{{ route('customer.products.index') }}" class="btn btn-primary">
                    <i class="bi bi-bag me-2"></i>Start Shopping
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function updateCartItemQuantity(itemId, action) {
        const inputElement = $(`.item-quantity[data-item-id="${itemId}"]`);
        let currentQty = parseInt(inputElement.val());
        const maxQty = parseInt(inputElement.attr('max'));

        if (action === 'increase' && currentQty < maxQty) {
            currentQty += 1;
        } else if (action === 'decrease' && currentQty > 1) {
            currentQty -= 1;
        } else {
            return; // No change needed
        }

        inputElement.val(currentQty);
        updateCartItem(itemId, currentQty);
    }

    function updateCartItem(itemId, quantity) {
        $.ajax({
            url: '{{ route("customer.cart.update") }}',
            type: 'POST',
            data: {
                cart_item_id: itemId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update item total
                $(`#cart-item-${itemId} .item-total`).text('$' + parseFloat(response.item_total).toFixed(2));

                // Update cart totals
                $('#cart-subtotal').text('$' + parseFloat(response.cart_total).toFixed(2));
                $('#cart-total').text('$' + parseFloat(response.cart_total).toFixed(2));

                // Update cart count in navbar if it exists
                if ($('.cart-count').length) {
                    $('.cart-count').text(response.cart_count);
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred while updating the cart.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error'
                });

                // Reset to previous value
                location.reload();
            }
        });
    }

    function removeCartItem(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This item will be removed from your cart.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("customer.cart.remove") }}',
                    type: 'POST',
                    data: {
                        cart_item_id: itemId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Remove item from DOM
                        $(`#cart-item-${itemId}`).fadeOut(300, function() {
                            $(this).remove();

                            // If no items left, reload page to show empty cart message
                            if ($('tbody tr').length === 0) {
                                location.reload();
                            }
                        });

                        // Update cart totals
                        $('#cart-subtotal').text('$' + parseFloat(response.cart_total).toFixed(2));
                        $('#cart-total').text('$' + parseFloat(response.cart_total).toFixed(2));

                        // Update cart count in navbar if it exists
                        if ($('.cart-count').length) {
                            $('.cart-count').text(response.cart_count);
                        }

                        Swal.fire(
                            'Removed!',
                            'The item has been removed from your cart.',
                            'success'
                        );
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'An error occurred while removing the item.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function clearCart() {
        Swal.fire({
            title: 'Are you sure?',
            text: "All items will be removed from your cart.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear cart!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("customer.cart.clear") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'An error occurred while clearing the cart.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    // Handle manual quantity input changes
    $('.item-quantity').on('change', function() {
        const itemId = $(this).data('item-id');
        const quantity = parseInt($(this).val());
        const maxQty = parseInt($(this).attr('max'));

        if (quantity < 1) {
            $(this).val(1);
            updateCartItem(itemId, 1);
        } else if (quantity > maxQty) {
            $(this).val(maxQty);
            updateCartItem(itemId, maxQty);
        } else {
            updateCartItem(itemId, quantity);
        }
    });
</script>
@endpush
