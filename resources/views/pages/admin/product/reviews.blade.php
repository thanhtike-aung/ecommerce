@extends('layouts.admin')

@section('title', 'Product Reviews - Nexwear')


@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Product Reviews</h1>
                    <p class="text-muted mb-0">Manage customer reviews for your products</p>
                </div>
                <div>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-chat-square-text fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Total Reviews</h5>
                    <h2 class="text-primary">{{ $reviews->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-check-circle fs-1 text-success mb-3"></i>
                    <h5 class="card-title">Approved</h5>
                    <h2 class="text-success">{{ $reviews->where('status', 1)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-clock fs-1 text-warning mb-3"></i>
                    <h5 class="card-title">Pending</h5>
                    <h2 class="text-warning">{{ $reviews->where('status', 0)->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-star-fill fs-1 text-info mb-3"></i>
                    <h5 class="card-title">Avg. Rating</h5>
                    <h2 class="text-info">{{ $reviews->count() > 0 ? number_format($reviews->avg('rating'), 1) : 'N/A' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Search Reviews</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search by title, comment or product...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status Filter</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="1">Approved</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Rating Filter</label>
                            <select class="form-select" id="ratingFilter">
                                <option value="">All Ratings</option>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-secondary" onclick="clearFilters()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-chat-square-text me-2"></i>Reviews List
                    </h5>
                </div>
                <div class="card-body">
                    @if($reviews->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Review</th>
                                        <th width="120">Rating</th>
                                        <th width="100">Status</th>
                                        <th width="120">Date</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="reviewsTableBody">
                                    @foreach($reviews as $index => $review)
                                    <tr data-review-id="{{ $review->id }}" data-status="{{ $review->status }}" data-rating="{{ $review->rating }}" data-title="{{ strtolower($review->title ?? '') }}" data-comment="{{ strtolower($review->comment ?? '') }}" data-product="{{ strtolower($review->product->name ?? '') }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($review->product && $review->product->thumbnail)
                                                    <img src="{{ asset('storage/images/' . $review->product->thumbnail) }}" alt="{{ $review->product->name }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-box-seam text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $review->product ? $review->product->name : 'Unknown Product' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $review->user ? $review->user->name : 'Anonymous' }}</td>
                                        <td>
                                            <div>
                                                <h6 class="mb-1">{{ $review->title }}</h6>
                                                <p class="text-muted mb-0 small">{{ \Illuminate\Support\Str::limit($review->comment, 100) }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm status-select" data-review-id="{{ $review->id }}">
                                                <option value="1" {{ $review->status == 1 ? 'selected' : '' }}>Approved</option>
                                                <option value="0" {{ $review->status == 0 ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </td>
                                        <td>{{ $review->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary" onclick="viewReview({{ $review->id }})" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteReview({{ $review->id }})" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <i class="bi bi-chat-square-text text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-muted">No Reviews Found</h4>
                            <p class="text-muted">There are no product reviews yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Details Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="reviewModalBody">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this review? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Review</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let reviewToDelete = null;

$(document).ready(function() {
    // Initialize filters
    setupFilters();

    // Status change handler
    $('.status-select').on('change', function() {
        const reviewId = $(this).data('review-id');
        const status = $(this).val();
        updateReviewStatus(reviewId, status);
    });

    // Show success message if redirected
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
});

function setupFilters() {
    // Search functionality
    $('#searchInput').on('input', function() {
        filterReviews();
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        filterReviews();
    });

    // Rating filter
    $('#ratingFilter').on('change', function() {
        filterReviews();
    });
}

function filterReviews() {
    const searchTerm = $('#searchInput').val().toLowerCase();
    const statusFilter = $('#statusFilter').val();
    const ratingFilter = $('#ratingFilter').val();

    $('#reviewsTableBody tr').each(function() {
        const $row = $(this);
        const title = $row.data('title');
        const comment = $row.data('comment');
        const product = $row.data('product');
        const status = $row.data('status').toString();
        const rating = $row.data('rating').toString();

        let show = true;

        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !comment.includes(searchTerm) && !product.includes(searchTerm)) {
            show = false;
        }

        // Status filter
        if (statusFilter && status !== statusFilter) {
            show = false;
        }

        // Rating filter
        if (ratingFilter && rating !== ratingFilter) {
            show = false;
        }

        $row.toggle(show);
    });
}

function clearFilters() {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    $('#ratingFilter').val('');
    filterReviews();
}

function viewReview(reviewId) {
    // Find the review data from the table row
    const $row = $(`tr[data-review-id="${reviewId}"]`);
    const title = $row.find('h6').first().text();
    const comment = $row.find('p').first().text();
    const rating = $row.data('rating');
    const product = $row.find('h6').eq(0).text();
    const customer = $row.find('td').eq(2).text();
    const date = $row.find('td').eq(6).text();
    const status = $row.data('status') == 1 ? 'Approved' : 'Pending';

    // Build stars HTML
    let starsHtml = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            starsHtml += '<i class="bi bi-star-fill text-warning"></i> ';
        } else {
            starsHtml += '<i class="bi bi-star text-warning"></i> ';
        }
    }

    // Build the HTML content for the modal
    let html = `
        <div class="mb-3">
            <h5>${title}</h5>
            <div>${starsHtml}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Comment:</label>
            <p>${comment}</p>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="fw-bold">Product:</label>
                <p>${product}</p>
            </div>
            <div class="col-md-6">
                <label class="fw-bold">Customer:</label>
                <p>${customer}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="fw-bold">Date:</label>
                <p>${date}</p>
            </div>
            <div class="col-md-6">
                <label class="fw-bold">Status:</label>
                <p><span class="badge bg-${status === 'Approved' ? 'success' : 'warning'}">${status}</span></p>
            </div>
        </div>
    `;

    // Update the modal content
    $('#reviewModalBody').html(html);

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
    modal.show();
}

function updateReviewStatus(reviewId, status) {
    // Send status update request
    $.ajax({
        url: `/admin/product/reviews/${reviewId}/status`,
        method: 'POST',
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            status: status
        },
        success: function(response) {
            showToast('Review status updated successfully!', 'success');

            // Update the row data attribute
            $(`tr[data-review-id="${reviewId}"]`).data('status', status);
        },
        error: function(xhr) {
            showToast('Failed to update review status. Please try again.', 'danger');

            // Revert the select to its previous value
            const previousStatus = $(`tr[data-review-id="${reviewId}"]`).data('status');
            $(`.status-select[data-review-id="${reviewId}"]`).val(previousStatus);
        }
    });
}

function deleteReview(reviewId) {
    reviewToDelete = reviewId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

$('#confirmDelete').on('click', function() {
    if (reviewToDelete) {
        // Show loading
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Deleting...');

        // Send delete request
        $.ajax({
            url: `/admin/product/reviews/${reviewToDelete}/delete`,
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                showToast('Review deleted successfully!', 'success');

                // Remove from table
                $(`tr[data-review-id="${reviewToDelete}"]`).fadeOut(function() {
                    $(this).remove();
                });
            },
            error: function(xhr) {
                showToast('Failed to delete review. Please try again.', 'danger');
            }
        })
        .always(function() {
            $('#confirmDelete').prop('disabled', false).html('Delete Review');
            reviewToDelete = null;
        });
    }
});
</script>
@endpush
