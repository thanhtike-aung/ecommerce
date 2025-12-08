@extends('layouts.admin')

@section('title', 'Edit Product - Nexwear')


@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Edit Product</h1>
                    <p class="text-muted mb-0">Update product information</p>
                </div>
                <div>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>Basic Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
                                <div class="form-text">URL-friendly version of the name</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                       id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                                <div class="form-text">Stock Keeping Unit (unique product identifier)</div>
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="thumbnail" class="form-label">Product Image</label>
                                @if($product->thumbnail)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/images/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 100px;">
                                        <div class="form-text">Current image</div>
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                       id="thumbnail" name="thumbnail" accept="image/*">
                                <div class="form-text">Upload new image to replace current one (optional)</div>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="brand_id" class="form-label">Brand <span class="text-danger">*</span></label>
                                <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror"
                                      id="short_description" name="short_description" rows="3" required>{{ old('short_description', $product->short_description) }}</textarea>
                            <div class="form-text">Brief summary of the product (max 500 characters)</div>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="long_description" class="form-label">Full Description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror"
                                      id="long_description" name="long_description" rows="6">{{ old('long_description', $product->long_description) }}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-image me-2"></i>Product Images
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="images" class="form-label">Add More Images</label>
                                <input type="file" class="form-control @error('images') is-invalid @enderror"
                                       id="images" name="images[]" accept="image/*" multiple>
                                <div class="form-text">Upload additional images for the product (optional)</div>
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row" id="imagePreviewContainer">
                            <!-- New image previews will be displayed here -->
                        </div>

                        @if($product->images && $product->images->count() > 0)
                            <h6 class="mt-4 mb-3">Current Images</h6>
                            <div class="row" id="existingImagesContainer">
                                @foreach($product->images as $image)
                                <div class="col-md-3 col-sm-4 col-6 mb-3" data-image-id="{{ $image->id }}">
                                    <div class="card h-100">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/images/' . $image->image) }}" class="card-img-top" alt="Product Image" style="height: 150px; object-fit: cover;">
                                            <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-1 delete-image" data-image-id="{{ $image->id }}" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-2">
                                            <small class="text-muted">Image #{{ $loop->iteration }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-tag me-2"></i>Pricing & Inventory
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Regular Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                           id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sale_price" class="form-label">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('sale_price') is-invalid @enderror"
                                           id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01" min="0">
                                </div>
                                <div class="form-text">Leave empty if not on sale</div>
                                @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="stock_qty" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock_qty') is-invalid @enderror"
                                       id="stock_qty" name="stock_qty" value="{{ old('stock_qty', $product->stock_qty) }}" min="0" required>
                                @error('stock_qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                       id="weight" name="weight" value="{{ old('weight', $product->weight) }}" step="0.01" min="0">
                                <div class="form-text">Product weight in kilograms (optional)</div>
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-gear me-2"></i>Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="form-text">Inactive products are not visible to customers</div>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input @error('featured') is-invalid @enderror"
                                           type="checkbox" id="featured" name="featured" value="1"
                                           {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        <i class="bi bi-star me-1"></i>Featured Product
                                    </label>
                                    <div class="form-text">Featured products are highlighted in listings</div>
                                    @error('featured')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mb-5">
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none me-2"></span>
                        <i class="bi bi-check-circle me-2"></i>Update Product
                    </button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-generate slug from name if slug is empty
    $('#name').on('input', function() {
        // Only update slug if it hasn't been manually edited
        if ($('#slug').data('manually-edited') !== true) {
            const name = $(this).val();
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            $('#slug').val(slug);
        }
    });

    // Track if slug has been manually edited
    $('#slug').on('input', function() {
        $(this).data('manually-edited', true);
    });

    // Validate sale price is less than regular price
    $('#sale_price, #price').on('input', function() {
        const regularPrice = parseFloat($('#price').val()) || 0;
        const salePrice = parseFloat($('#sale_price').val()) || 0;

        if (salePrice >= regularPrice && salePrice > 0) {
            $('#sale_price').addClass('is-invalid');
            $('#sale_price').next('.form-text').html('<span class="text-danger">Sale price must be less than regular price</span>');
        } else {
            $('#sale_price').removeClass('is-invalid');
            $('#sale_price').next('.form-text').text('Leave empty if not on sale');
        }
    });

    // Image preview functionality for new images
    $('#images').on('change', function(e) {
        // Clear previous previews
        $('#imagePreviewContainer').empty();

        const files = e.target.files;
        if (!files || files.length === 0) {
            return;
        }

        // Create preview for each selected file
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.match('image.*')) {
                continue;
            }

            const reader = new FileReader();
            reader.onload = (function(file) {
                return function(e) {
                    const previewCol = $('<div class="col-md-3 col-sm-4 col-6 mb-3"></div>');
                    const previewCard = $(`
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="${e.target.result}" class="card-img-top" alt="Preview" style="height: 150px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-1 remove-preview" title="Remove">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <p class="card-text small text-truncate mb-0">${file.name}</p>
                                <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                            </div>
                        </div>
                    `);

                    previewCol.append(previewCard);
                    $('#imagePreviewContainer').append(previewCol);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    });

    // Remove preview when clicking the remove button
    $(document).on('click', '.remove-preview', function(e) {
        e.preventDefault();
        $(this).closest('.col-md-3').remove();
    });

    // Handle deletion of existing images
    $(document).on('click', '.delete-image', function(e) {
        e.preventDefault();
        const imageId = $(this).data('image-id');
        const imageElement = $(this).closest('.col-md-3');

        if (confirm('Are you sure you want to delete this image?')) {
            // Add a hidden input to track deleted images
            $('#productForm').append(`<input type="hidden" name="deleted_images[]" value="${imageId}">`);

            // Hide the image with animation
            imageElement.fadeOut(function() {
                $(this).remove();
            });
        }
    });

    // Form submission
    $('#productForm').on('submit', function(e) {
        if (!validateForm('#productForm')) {
            e.preventDefault();
            return false;
        }

        // Additional validation for sale price
        const regularPrice = parseFloat($('#price').val()) || 0;
        const salePrice = parseFloat($('#sale_price').val()) || 0;

        if (salePrice >= regularPrice && salePrice > 0) {
            e.preventDefault();
            $('#sale_price').addClass('is-invalid');
            $('#sale_price').next('.form-text').html('<span class="text-danger">Sale price must be less than regular price</span>');
            return false;
        }

        showLoading($(this).find('button[type="submit"]'));
    });
});

function validateForm(formSelector) {
    const form = document.querySelector(formSelector);
    if (!form.checkValidity()) {
        form.reportValidity();
        return false;
    }
    return true;
}
</script>
@endpush
