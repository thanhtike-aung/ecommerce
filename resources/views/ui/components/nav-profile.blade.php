@if (auth()->check())
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex align-items-center">
                @if (auth()->user()->profile_photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="rounded-circle me-2" width="32" height="32">
                @else
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                        <span class="text-white fw-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                @endif
                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdownProfile">
            <li class="px-3 py-2 d-flex flex-column">
                <span class="fw-bold">{{ auth()->user()->name }}</span>
                <span class="text-muted small">{{ auth()->user()->email }}</span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('customer.profile.show') }}"><i class="bi bi-person me-2"></i> My Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('customer.orders.index') }}"><i class="bi bi-bag me-2"></i> My Orders</a></li>
            <li><a class="dropdown-item" href="{{ route('customer.wishlist.index') }}"><i class="bi bi-heart me-2"></i> Wishlist</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item text-danger" href="#" id="logout">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </li>
@else
    <li class="nav-item">
        <a class="btn btn-outline-primary ms-2" href="{{ route('customer.login') }}">Login</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary ms-2" href="{{ route('customer.register') }}">Sign Up</a>
    </li>
@endif

@push('scripts')
<script>
$(document).ready(function() {
    $('#logout').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/customer/logout',
            type: 'POST',
            success: function(response) {
                window.location.href = '/';
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
</script>
@endpush
