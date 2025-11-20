@extends('layouts.guest')

@section('title', 'Login - Nexwear')

@push('styles')

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            min-height: 600px;
            display: flex;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
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

        .login-right {
            padding: 60px 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .brand-tagline {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .welcome-text {
            font-size: 28px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            color: #718096;
            margin-bottom: 40px;
            font-size: 16px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating > .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px 16px 8px 16px;
            height: auto;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-floating > .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-floating > label {
            padding: 16px;
            color: #718096;
            font-weight: 500;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #718096;
            cursor: pointer;
            z-index: 5;
            padding: 4px;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-login .spinner-border {
            width: 20px;
            height: 20px;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 30px 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 20px;
            color: #718096;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 12px;
        }

        .btn-social {
            flex: 1;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            background: white;
            color: #4a5568;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: #cbd5e0;
            transform: translateY(-1px);
            color: #2d3748;
        }

        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            background: #fed7d7;
            color: #c53030;
            border-left: 4px solid #e53e3e;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin-top: 40px;
            position: relative;
            z-index: 1;
        }

        .feature-list li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            opacity: 0.9;
        }

        .feature-list li i {
            margin-right: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 10px;
            }

            .login-left {
                padding: 40px 30px;
                text-align: center;
            }

            .login-right {
                padding: 40px 30px;
            }

            .feature-list {
                display: none;
            }
        }
    </style>
@endpush

@section('content')

<div class="login-container">
    <!-- Left Side - Branding -->
    <div class="login-left col-md-5 d-none d-md-flex">
        <div>
            <div class="brand-logo">
                <i class="bi bi-shop"></i> ShopZone
            </div>
            <div class="brand-tagline">
                Your premium ecommerce destination
            </div>

            <ul class="feature-list">
                <li>
                    <i class="bi bi-shield-check"></i>
                    Secure & encrypted transactions
                </li>
                <li>
                    <i class="bi bi-truck"></i>
                    Fast & reliable delivery
                </li>
                <li>
                    <i class="bi bi-headset"></i>
                    24/7 customer support
                </li>
                <li>
                    <i class="bi bi-award"></i>
                    Premium quality products
                </li>
            </ul>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="login-right col-md-7">
        <div class="w-100">
            <div class="welcome-text">Welcome back!</div>
            <div class="welcome-subtitle">Please sign in to your account</div>

            <div id="errorBox" class="alert-modern d-none">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span id="errorMessage"></span>
            </div>

            <form id="loginForm">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                    <label for="floatingEmail">
                        <i class="bi bi-envelope me-2"></i>Email address
                    </label>
                </div>

                <div class="form-floating position-relative">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">
                        <i class="bi bi-lock me-2"></i>Password
                    </label>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                        <label class="form-check-label text-muted" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                    <a href="{{ route('customer.password.request') }}" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-login text-white w-100" id="loginBtn">
                    <span class="btn-text">Sign In</span>
                    <div class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </form>
            <div class="text-center mt-4">
                <span class="text-muted">Don't have an account? </span>
                <a href="{{ route('customer.register') }}" class="forgot-password">Sign up</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
    // Password toggle functionality
    $('#togglePassword').on('click', function() {
        const passwordField = $('#floatingPassword');
        const eyeIcon = $('#eyeIcon');

        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            eyeIcon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            eyeIcon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });

    // Form validation and submission
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        const $form = $(this);
        const $submitBtn = $('#loginBtn');
        const $btnText = $submitBtn.find('.btn-text');
        const $spinner = $submitBtn.find('.spinner-border');
        const $errorBox = $('#errorBox');

        // Reset error state
        $errorBox.addClass('d-none');
        $('.form-control').removeClass('is-invalid');

        // Show loading state
        $submitBtn.prop('disabled', true);
        $btnText.text('Signing in...');
        $spinner.removeClass('d-none');

        $.ajax({
            url: "{{ route('customer.login') }}",
            method: "POST",
            data: $form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if (res.success) {
                    $btnText.text('Success!');
                    $submitBtn.removeClass('btn-login').addClass('btn-success');

                    // Add success animation
                    setTimeout(function() {
                        window.location.href = res.redirect || '/dashboard';
                    }, 1000);
                } else {
                    showError(res.message || 'Login failed. Please try again.');
                    resetButton();
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred. Please try again.';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    const errorMessages = [];

                    // Highlight invalid fields
                    for (let field in errors) {
                        $(`[name="${field}"]`).addClass('is-invalid');
                        errorMessages.push(errors[field][0]);
                    }

                    errorMessage = errorMessages.join(' ');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                showError(errorMessage);
                resetButton();
            }
        });
    });

    // Helper functions
    function showError(message) {
        $('#errorMessage').text(message);
        $('#errorBox').removeClass('d-none').hide().fadeIn(300);
    }

    function resetButton() {
        const $submitBtn = $('#loginBtn');
        const $btnText = $submitBtn.find('.btn-text');
        const $spinner = $submitBtn.find('.spinner-border');

        setTimeout(function() {
            $submitBtn.prop('disabled', false);
            $btnText.text('Sign In');
            $spinner.addClass('d-none');
            $submitBtn.removeClass('btn-success').addClass('btn-login');
        }, 1500);
    }

    // Remove validation errors on input
    $('.form-control').on('input', function() {
        $(this).removeClass('is-invalid');
        if ($('.form-control.is-invalid').length === 0) {
            $('#errorBox').fadeOut(300);
        }
    });

    // Social login placeholders (you can implement actual OAuth later)
    $('.btn-social').on('click', function() {
        const provider = $(this).text().trim().toLowerCase();
        alert(`${provider} login will be implemented soon!`);
    });

    // Add subtle animations on focus
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        if (!$(this).val()) {
            $(this).parent().removeClass('focused');
        }
    });

    // Auto-fill demo (remove in production)
    // if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    //     setTimeout(function() {
    //         $('#floatingEmail').val('demo@shopzone.com');
    //         $('#floatingPassword').val('password123');
    //     }, 500);
    // }
});
</script>
@endpush
