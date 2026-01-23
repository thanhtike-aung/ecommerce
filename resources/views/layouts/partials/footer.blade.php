<footer class="bg-light py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 mb-4">
                <h5><i class="bi bi-shop"></i> Nexwear</h5>
                <p class="text-muted">Your premium ecommerce destination for quality products and exceptional service.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-muted"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                    <li><a href="{{ route('customer.products.index') }}" class="text-muted">Products</a></li>
                    <li><a href="{{ route('customer.categories.index') }}" class="text-muted">Categories</a></li>
                    <li><a href="{{ route('customer.about.index') }}" class="text-muted">About Us</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('customer.dashboard') }}" class="text-muted">Help Center</a></li>
                    <li><a href="#" class="text-muted">Contact Us</a></li>
                    <li><a href="{{ route('customer.orders.index') }}" class="text-muted">My Orders</a></li>
                    <li><a href="{{ route('customer.cart.index') }}" class="text-muted">My Cart</a></li>
                </ul>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <p class="mb-0 text-muted">&copy; 2024 Nexwear. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted">
                    <a href="#" class="text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-muted">Terms of Service</a>
                </p>
            </div>
        </div>
    </div>
</footer>
