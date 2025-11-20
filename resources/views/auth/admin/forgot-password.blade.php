@extends('layouts.guest')

@section('title', 'Admin Password Reset')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0 rounded-lg mt-5">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="my-2">
                        <i class="bi bi-shield-lock me-2"></i> Admin Password Reset
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="small text-center text-muted mb-4">
                        Enter your email address and we will send you a link to reset your password.
                    </div>

                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-envelope me-2"></i> Send Reset Link
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 bg-light">
                    <div class="small">
                        <a href="{{ route('admin.login') }}" class="text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
