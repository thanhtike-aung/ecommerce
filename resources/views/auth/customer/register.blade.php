@extends('layouts.guest')

@section('title', 'Sign Up - Nexwear')

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

        .signup-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            min-height: 650px;
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

        .signup-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .signup-left::before {
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

        .signup-right {
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

        .btn-signup {
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

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-signup:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-signup .spinner-border {
            width: 20px;
            height: 20px;
        }

        .login-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: #764ba2;
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

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-weak { color: #e53e3e; }
        .strength-medium { color: #dd6b20; }
        .strength-strong { color: #38a169; }

        .terms-text {
            font-size: 14px;
            color: #718096;
            line-height: 1.5;
        }

        .terms-text a {
            color: #667eea;
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .signup-container {
                flex-direction: column;
                margin: 10px;
            }

            .signup-left {
                padding: 40px 30px;
                text-align: center;
            }

            .signup-right {
                padding: 40px 30px;
            }

            .feature-list {
                display: none;
            }
        }
    </style>
@endpush

@section('content')

<div class="signup-container">
    <!-- Left Side - Branding -->
    <div class="signup-left col-md-5 d-none d-md-flex">
        <div>
            <div class="brand-logo">
                <i class="bi bi-shop"></i> ShopZone
            </div>
            <div class="brand-tagline">
                Join our premium ecommerce community
            </div>

            <ul class="feature-list">
                <li>
                    <i class="bi bi-check-circle"></i>
                    Free account registration
                </li>
                <li>
                    <i class="bi bi-shield-check"></i>
                    Secure & encrypted data
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
                <li>
                    <i class="bi bi-percent"></i>
                    Exclusive member discounts
                </li>
            </ul>
        </div>
    </div>

    <!-- Right Side - Signup Form -->
    <div class="signup-right col-md-7">
        <div class="w-100">
            <div class="welcome-text">Create Account</div>
            <div class="welcome-subtitle">Join NEXWEAR today and start shopping</div>

            <div id="errorBox" class="alert-modern d-none">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span id="errorMessage"></span>
            </div>

            <form id="signupForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Name" required>
                            <label for="floatingName">
                                <i class="bi bi-person me-2"></i>Name
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                    <label for="floatingEmail">
                        <i class="bi bi-envelope me-2"></i>Email address
                    </label>
                </div>

                <div class="form-floating position-relative">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required minlength="6">
                    <label for="floatingPassword">
                        <i class="bi bi-lock me-2"></i>Password
                    </label>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                <div class="password-strength" id="passwordStrength"></div>

                <div class="form-floating position-relative">
                    <input type="password" name="password_confirmation" class="form-control" id="floatingPasswordConfirm" placeholder="Confirm Password" required>
                    <label for="floatingPasswordConfirm">
                        <i class="bi bi-lock me-2"></i>Confirm Password
                    </label>
                    <button type="button" class="password-toggle" id="togglePasswordConfirm">
                        <i class="bi bi-eye" id="eyeIconConfirm"></i>
                    </button>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree_terms" required>
                    <label class="form-check-label terms-text" for="agreeTerms">
                        I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                    </label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                    <label class="form-check-label terms-text" for="newsletter">
                        Subscribe to our newsletter for exclusive offers and updates
                    </label>
                </div>

                <button type="submit" class="btn btn-signup text-white w-100" id="signupBtn">
                    <span class="btn-text">Create Account</span>
                    <div class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </form>

            <div class="text-center mt-4">
                <span class="text-muted">Already have an account? </span>
                <a href="{{ route('customer.login') }}" class="forgot-password">Sign in</a>
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

    $('#togglePasswordConfirm').on('click', function() {
        const passwordField = $('#floatingPasswordConfirm');
        const eyeIcon = $('#eyeIconConfirm');

        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            eyeIcon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            eyeIcon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });

    // Password strength checker
    $('#floatingPassword').on('input', function() {
        const password = $(this).val();
        const strengthDiv = $('#passwordStrength');

        if (password.length === 0) {
            strengthDiv.html('');
            return;
        }

        let strength = 0;
        let feedback = [];

        // // Length check
        // if (password.length >= 8) strength++;
        // else feedback.push('At least 8 characters');

        // // Uppercase check
        // if (/[A-Z]/.test(password)) strength++;
        // else feedback.push('One uppercase letter');

        // // Lowercase check
        // if (/[a-z]/.test(password)) strength++;
        // else feedback.push('One lowercase letter');

        // // Number check
        // if (/\d/.test(password)) strength++;
        // else feedback.push('One number');

        // let strengthText = '';
        // let strengthClass = '';

        // if (strength < 3) {
        //     strengthText = 'Weak';
        //     strengthClass = 'strength-weak';
        // } else if (strength < 5) {
        //     strengthText = 'Medium';
        //     strengthClass = 'strength-medium';
        // } else {
        //     strengthText = 'Strong';
        //     strengthClass = 'strength-strong';
        // }

        strengthDiv.html(`
            <div class="${strengthClass}">
                <i class="bi bi-shield-${strength < 3 ? 'exclamation' : strength < 5 ? 'check' : 'fill-check'} me-1"></i>
                Password strength: ${strengthText}
                ${feedback.length > 0 ? '<br><small>Missing: ' + feedback.join(', ') + '</small>' : ''}
            </div>
        `);
    });

    // Password confirmation validation
    $('#floatingPasswordConfirm').on('input', function() {
        const password = $('#floatingPassword').val();
        const confirmPassword = $(this).val();

        if (confirmPassword && password !== confirmPassword) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // Form validation and submission
    $('#signupForm').on('submit', function(e) {
        e.preventDefault();

        const $form = $(this);
        const $submitBtn = $('#signupBtn');
        const $btnText = $submitBtn.find('.btn-text');
        const $spinner = $submitBtn.find('.spinner-border');
        const $errorBox = $('#errorBox');

        // Reset error state
        $errorBox.addClass('d-none');
        $('.form-control').removeClass('is-invalid');

        // Validate passwords match
        const password = $('#floatingPassword').val();
        const confirmPassword = $('#floatingPasswordConfirm').val();

        if (password !== confirmPassword) {
            showError('Passwords do not match.');
            $('#floatingPasswordConfirm').addClass('is-invalid');
            return;
        }

        // Show loading state
        $submitBtn.prop('disabled', true);
        $btnText.text('Creating Account...');
        $spinner.removeClass('d-none');

        $.ajax({
            url: "{{ route('customer.register') }}",
            method: "POST",
            data: $form.serialize(),
            success: function(res) {
                if (res.success) {
                    $btnText.text('Account Created!');
                    $submitBtn.removeClass('btn-signup').addClass('btn-success');

                    // Show success message
                    showToast('Account created successfully! Redirecting...', 'success');

                    // Redirect after success
                    setTimeout(function() {
                        window.location.href = res.redirect || '/dashboard';
                    }, 1500);
                } else {
                    showError(res.message || 'Registration failed. Please try again.');
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
        const $submitBtn = $('#signupBtn');
        const $btnText = $submitBtn.find('.btn-text');
        const $spinner = $submitBtn.find('.spinner-border');

        setTimeout(function() {
            $submitBtn.prop('disabled', false);
            $btnText.text('Create Account');
            $spinner.addClass('d-none');
            $submitBtn.removeClass('btn-success').addClass('btn-signup');
        }, 1500);
    }

    // Remove validation errors on input
    $('.form-control').on('input', function() {
        $(this).removeClass('is-invalid');
        if ($('.form-control.is-invalid').length === 0) {
            $('#errorBox').fadeOut(300);
        }
    });

    // Add subtle animations on focus
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        if (!$(this).val()) {
            $(this).parent().removeClass('focused');
        }
    });
});
</script>
@endpush
