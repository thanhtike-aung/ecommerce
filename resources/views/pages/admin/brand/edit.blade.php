@extends('layouts.admin')

@section('title', 'Edit Brand - ShopZone')


@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Edit Brand</h1>
                    <p class="text-muted mb-0">Update brand information</p>
                </div>
                <div>
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Brands
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil me-2"></i>Brand Information
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data" id="brandForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $brand->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug', $brand->slug) }}" required>
                                <div class="form-text">URL-friendly version of the name</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Brand Logo/Image</label>
                            @if($brand->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/images/' . $brand->thumbnail) }}" alt="{{ $brand->name }}" class="img-thumbnail" style="max-height: 100px;">
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

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sort" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort') is-invalid @enderror"
                                       id="sort" name="sort" value="{{ old('sort', $brand->sort ?? 0) }}" min="0">
                                <div class="form-text">Higher numbers appear first</div>
                                @error('sort')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input @error('featured') is-invalid @enderror"
                                       type="checkbox" id="featured" name="featured" value="1"
                                       {{ old('featured', $brand->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    <i class="bi bi-star me-1"></i>Featured Brand
                                </label>
                                <div class="form-text">Featured brands are highlighted in listings</div>
                                @error('featured')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <span class="spinner-border spinner-border-sm d-none me-2"></span>
                                <i class="bi bi-check-circle me-2"></i>Update Brand
                            </button>
                            <a href="{{ route('admin.brand.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
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

    // Form submission
    $('#brandForm').on('submit', function(e) {
        if (!validateForm('#brandForm')) {
            e.preventDefault();
            return false;
        }

        showLoading($(this).find('button[type="submit"]'));
    });
});

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        showToast('Logged out successfully!', 'success');
        setTimeout(() => {
            window.location.href = '/login';
        }, 1500);
    }
}
</script>
@endpush
