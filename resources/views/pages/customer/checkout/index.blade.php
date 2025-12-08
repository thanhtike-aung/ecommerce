@extends('layouts.app')

@section('title', 'Checkout - ')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.cart.index') }}">Shopping Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>

    <h1 class="mb-4">Checkout</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('customer.checkout.process') }}" method="POST" id="checkout-form">
        @csrf
        <div class="row">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="shipping_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('shipping_name') is-invalid @enderror"
                                       id="shipping_name" name="shipping_name" value="{{ old('shipping_name', $user->name ?? '') }}" required>
                                @error('shipping_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="shipping_email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('shipping_email') is-invalid @enderror"
                                       id="shipping_email" name="shipping_email" value="{{ old('shipping_email', $user->email ?? '') }}" required>
                                @error('shipping_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="shipping_phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('shipping_phone') is-invalid @enderror"
                                       id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone', $user->phone ?? '') }}" required>
                                @error('shipping_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="shipping_address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('shipping_address') is-invalid @enderror"
                                       id="shipping_address" name="shipping_address" value="{{ old('shipping_address', $user->address ?? '') }}" required>
                                @error('shipping_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="shipping_city" class="form-label">City</label>
                                <input type="text" class="form-control @error('shipping_city') is-invalid @enderror"
                                       id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required>
                                @error('shipping_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="shipping_state" class="form-label">State/Province</label>
                                <input type="text" class="form-control @error('shipping_state') is-invalid @enderror"
                                       id="shipping_state" name="shipping_state" value="{{ old('shipping_state') }}" required>
                                @error('shipping_state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="shipping_zip" class="form-label">Zip/Postal</label>
                                <input type="text" class="form-control @error('shipping_zip') is-invalid @enderror"
                                       id="shipping_zip" name="shipping_zip" value="{{ old('shipping_zip') }}" required>
                                @error('shipping_zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="shipping_country" class="form-label">Country</label>
                                <select class="form-select @error('shipping_country') is-invalid @enderror"
                                        id="shipping_country" name="shipping_country" required>
                                    <option value="">Select Country</option>
                                    <option value="Taiwan" {{ old('shipping_country') == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                                    <option value="Myanmar" {{ old('shipping_country') == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                </select>
                                @error('shipping_country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Billing Information</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="billing_same_as_shipping" name="billing_same_as_shipping" value="1"
                                   {{ old('billing_same_as_shipping') ? 'checked' : '' }}>
                            <label class="form-check-label" for="billing_same_as_shipping">
                                Same as shipping address
                            </label>
                        </div>
                    </div>
                    <div class="card-body" id="billing-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="billing_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('billing_name') is-invalid @enderror"
                                       id="billing_name" name="billing_name" value="{{ old('billing_name', $user->name ?? '') }}">
                                @error('billing_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="billing_email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('billing_email') is-invalid @enderror"
                                       id="billing_email" name="billing_email" value="{{ old('billing_email', $user->email ?? '') }}">
                                @error('billing_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="billing_phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('billing_phone') is-invalid @enderror"
                                       id="billing_phone" name="billing_phone" value="{{ old('billing_phone') }}">
                                @error('billing_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="billing_address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('billing_address') is-invalid @enderror"
                                       id="billing_address" name="billing_address" value="{{ old('billing_address') }}">
                                @error('billing_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="billing_city" class="form-label">City</label>
                                <input type="text" class="form-control @error('billing_city') is-invalid @enderror"
                                       id="billing_city" name="billing_city" value="{{ old('billing_city') }}">
                                @error('billing_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="billing_state" class="form-label">State/Province</label>
                                <input type="text" class="form-control @error('billing_state') is-invalid @enderror"
                                       id="billing_state" name="billing_state" value="{{ old('billing_state') }}">
                                @error('billing_state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="billing_zip" class="form-label">Zip/Postal</label>
                                <input type="text" class="form-control @error('billing_zip') is-invalid @enderror"
                                       id="billing_zip" name="billing_zip" value="{{ old('billing_zip') }}">
                                @error('billing_zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="billing_country" class="form-label">Country</label>
                                <select class="form-select @error('billing_country') is-invalid @enderror"
                                        id="billing_country" name="billing_country">
                                    <option value="">Select Country</option>
                                    <option value="United States" {{ old('billing_country') == 'United States' ? 'selected' : '' }}>United States</option>
                                    <option value="Canada" {{ old('billing_country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    <option value="United Kingdom" {{ old('billing_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                    <option value="Australia" {{ old('billing_country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                    <option value="Myanmar" {{ old('billing_country') == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                    <!-- Add more countries as needed -->
                                </select>
                                @error('billing_country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" checked>
                            <label class="form-check-label" for="payment_cod">
                                <i class="bi bi-cash me-2"></i>Cash on Delivery
                            </label>
                            <small class="d-block text-muted mt-1">Pay with cash upon delivery.</small>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card" disabled>
                            <label class="form-check-label" for="payment_card">
                                <i class="bi bi-credit-card me-2"></i>Credit/Debit Card
                            </label>
                            <small class="d-block text-muted mt-1 opacity-50">Pay securely with your card. (Currently unavailable)</small>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Notes</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="notes" class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            <small class="text-muted">Add any special instructions or notes for your order.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4 sticky-top" style="top: 100px;">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->items as $item)
                                        <tr>
                                            <td>
                                                {{ $item->product->name }} <span class="text-muted">× {{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end">${{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td class="text-end">${{ number_format($cart->total_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td class="text-end">Free</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td class="text-end fs-5 fw-bold">${{ number_format($cart->total_price, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-lock me-2"></i>Place Order
                            </button>
                            <a href="{{ route('customer.cart.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Return to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle billing same as shipping checkbox
        $('#billing_same_as_shipping').change(function() {
            if ($(this).is(':checked')) {
                $('#billing-form').slideUp();
            } else {
                $('#billing-form').slideDown();
            }
        });

        // Trigger the change event on page load
        $('#billing_same_as_shipping').trigger('change');

        // Form validation
        $('#checkout-form').submit(function(e) {
            let isValid = true;

            // If billing same as shipping is not checked, validate billing fields
            if (!$('#billing_same_as_shipping').is(':checked')) {
                $('#billing-form input, #billing-form select').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
            }

            if (!isValid) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('.is-invalid').first().offset().top - 100
                }, 500);
            }
        });
    });
</script>
@endpush
