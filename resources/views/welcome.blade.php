@extends('layouts.app')

@section('title', 'ShopZone - Your Premium Ecommerce Destination')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
        animation: float 20s linear infinite;
    }

    @keyframes float {
        0% { transform: translateX(-100px) translateY(-100px); }
        100% { transform: translateX(100px) translateY(100px); }
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .btn-hero {
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .section-padding {
        padding: 80px 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 3rem;
        color: #2d3748;
    }

    .category-card {
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 300px;
        position: relative;
        background-size: cover;
        background-position: center;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .product-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        height: 250px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: #dee2e6;
    }

    .stats-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 0.5rem;
    }

    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin: 0 auto 1rem;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('navigation')
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-shop text-primary"></i> Nexwear
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('brand.index') }}">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
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
                    <a class="nav-link" href="#"><i class="bi bi-cart3"></i> <span class="badge bg-primary">0</span></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary ms-2" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary ms-2" href="{{ route('register') }}">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">Welcome to Nexwear</h1>
                    <p class="hero-subtitle">Discover premium products with unbeatable prices and exceptional quality. Your ultimate shopping destination awaits.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#products" class="btn btn-light btn-hero">Shop Now</a>
                        <a href="#categories" class="btn btn-outline-light btn-hero">Browse Categories</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <i class="bi bi-bag-check" style="font-size: 15rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">5K+</div>
                    <div class="stat-label">Products</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="section-padding">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="category-card" style="background-image: linear-gradient(45deg, #667eea, #764ba2);">
                    <div class="category-overlay">
                        <div>
                            <i class="bi bi-laptop" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <h4>Electronics</h4>
                            <p>Latest gadgets and tech</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="category-card" style="background-image: linear-gradient(45deg, #f093fb, #f5576c);">
                    <div class="category-overlay">
                        <div>
                            <i class="bi bi-person-circle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <h4>Fashion</h4>
                            <p>Trendy clothing & accessories</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="category-card" style="background-image: linear-gradient(45deg, #4facfe, #00f2fe);">
                    <div class="category-overlay">
                        <div>
                            <i class="bi bi-house" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <h4>Home & Living</h4>
                            <p>Beautiful home essentials</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section id="products" class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card product-card">
                    <div class="product-image">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Premium Laptop</h5>
                        <p class="card-text text-muted">High-performance laptop for professionals</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">$1,299</span>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card product-card">
                    <div class="product-image">
                        <i class="bi bi-headphones"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Wireless Headphones</h5>
                        <p class="card-text text-muted">Premium sound quality headphones</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">$199</span>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card product-card">
                    <div class="product-image">
                        <i class="bi bi-watch"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Smart Watch</h5>
                        <p class="card-text text-muted">Advanced fitness and health tracking</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">$299</span>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card product-card">
                    <div class="product-image">
                        <i class="bi bi-phone"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Smartphone</h5>
                        <p class="card-text text-muted">Latest flagship smartphone</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">$899</span>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-primary btn-lg">View All Products</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section id="about" class="section-padding">
    <div class="container">
        <h2 class="section-title">What Our Customers Say</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <p class="mb-3">"Amazing products and fast delivery! ShopZone has become my go-to online store."</p>
                    <h6 class="fw-bold">Sarah Johnson</h6>
                    <small class="text-muted">Verified Customer</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <p class="mb-3">"Excellent customer service and high-quality products. Highly recommended!"</p>
                    <h6 class="fw-bold">Mike Chen</h6>
                    <small class="text-muted">Verified Customer</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <p class="mb-3">"Great prices and fantastic shopping experience. Will definitely shop again!"</p>
                    <h6 class="fw-bold">Emily Davis</h6>
                    <small class="text-muted">Verified Customer</small>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5><i class="bi bi-shop"></i> ShopZone</h5>
                <p class="text-muted">Your premium ecommerce destination for quality products and exceptional service.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted">Home</a></li>
                    <li><a href="#" class="text-muted">Products</a></li>
                    <li><a href="#" class="text-muted">Categories</a></li>
                    <li><a href="#" class="text-muted">About Us</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-4">
                <h6>Support</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted">Help Center</a></li>
                    <li><a href="#" class="text-muted">Contact Us</a></li>
                    <li><a href="#" class="text-muted">Shipping Info</a></li>
                    <li><a href="#" class="text-muted">Returns</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h6>Newsletter</h6>
                <p class="text-muted">Subscribe for exclusive offers and updates</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button class="btn btn-primary" type="button">Subscribe</button>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0 text-muted">&copy; 2024 ShopZone. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="#" class="text-muted me-3">Privacy Policy</a>
                <a href="#" class="text-muted">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Smooth scrolling for navigation links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();

        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });

    // Navbar background on scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('navbar-scrolled');
        } else {
            $('.navbar').removeClass('navbar-scrolled');
        }
    });

    // Add to cart functionality
    $('.btn:contains("Add to Cart")').on('click', function() {
        const productName = $(this).closest('.card').find('.card-title').text();
        showToast(`${productName} added to cart!`, 'success');

        // Update cart badge
        const currentCount = parseInt($('.badge').text()) || 0;
        $('.badge').text(currentCount + 1);
    });

    // Newsletter subscription
    $('button:contains("Subscribe")').on('click', function() {
        const email = $(this).siblings('input[type="email"]').val();
        if (email) {
            showToast('Thank you for subscribing!', 'success');
            $(this).siblings('input[type="email"]').val('');
        } else {
            showToast('Please enter a valid email address', 'warning');
        }
    });
});
</script>
@endpush
