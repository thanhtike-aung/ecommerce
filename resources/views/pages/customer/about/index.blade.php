@extends('layouts.app')

@section('title', 'About Us - Nexwear')

@section('navigation')
    @include('layouts.partials.navbar', ['isFixed' => true])
@endsection

@section('content')
<div class="container py-5 mt-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold mb-4">About {{ $company['name'] }}</h1>
            <p class="lead text-muted mb-4">Founded in {{ $company['founded'] }}, we've been dedicated to providing exceptional products and services to our customers.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('customer.products.index') }}" class="btn btn-primary px-4 py-2">Explore Products</a>
                <a href="#team" class="btn btn-outline-secondary px-4 py-2">Meet Our Developer</a>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card h-100">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-bullseye text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="card-title">Our Mission</h3>
                    <p class="card-text">{{ $company['mission'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-eye text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="card-title">Our Vision</h3>
                    <p class="card-text">{{ $company['vision'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div id="team" class="py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Meet Our Developer</h2>
                <p class="text-muted">The talented individual behind {{ $company['name'] }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card team-card h-100">
                    <div class="text-center p-4">
                        <div class="mb-4 mx-auto" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; background-color: #f8f9fa;">
                            <i class="bi bi-person-circle text-primary" style="font-size: 150px;"></i>
                        </div>
                        <h4 class="mb-1">{{ $developer['name'] }}</h4>
                        <p class="text-muted mb-3">{{ $developer['role'] }}</p>
                        <p>{{ $developer['bio'] }}</p>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <a href="{{ $developer['social']['github'] }}" class="text-dark" target="_blank">
                                <i class="bi bi-github" style="font-size: 1.5rem;"></i>
                            </a>
                            <a href="{{ $developer['social']['linkedin'] }}" class="text-primary" target="_blank">
                                <i class="bi bi-linkedin" style="font-size: 1.5rem;"></i>
                            </a>
                            <a href="{{ $developer['social']['twitter'] }}" class="text-info" target="_blank">
                                <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="row mt-5 py-5">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="fw-bold mb-4">Get In Touch</h2>
            <p class="text-muted mb-5">Have questions or feedback? We'd love to hear from you!</p>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-envelope text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h5>Email Us</h5>
                        <p class="text-muted">contact@nexwear.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-telephone text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h5>Call Us</h5>
                        <p class="text-muted">+1 (555) 123-4567</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-geo-alt text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h5>Visit Us</h5>
                        <p class="text-muted">123 Commerce St, Tech City</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.partials.footer')
@endsection

@push('styles')
<style>
    .team-card {
        transition: all 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
