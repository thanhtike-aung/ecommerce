<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ShopZone - Your Premium Ecommerce Destination')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .card {
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .nav-link:hover {
            color: #667eea !important;
        }

        .btn-outline-primary:hover {
            background-color: #667eea;
            border-color: #667eea;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation (if needed) -->
    @hasSection('navigation')
        @yield('navigation')
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer (if needed) -->
    @hasSection('footer')
        @yield('footer')
    @endif

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Global JavaScript -->
    <script>
        // Global jQuery setup
        $(document).ready(function() {
            // Global CSRF token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Global loading overlay function
            window.showLoading = function(element) {
                $(element).prop('disabled', true);
                $(element).find('.spinner-border').removeClass('d-none');
            };

            window.hideLoading = function(element) {
                $(element).prop('disabled', false);
                $(element).find('.spinner-border').addClass('d-none');
            };

            // Global toast notification function
            window.showToast = function(message, type = 'success') {
                const toastHtml = `
                    <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `;

                if (!$('#toastContainer').length) {
                    $('body').append('<div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3"></div>');
                }

                const $toast = $(toastHtml);
                $('#toastContainer').append($toast);

                const toast = new bootstrap.Toast($toast[0]);
                toast.show();

                $toast.on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            };

            // Global form validation helper
            window.validateForm = function(formSelector) {
                let isValid = true;
                $(formSelector + ' [required]').each(function() {
                    if (!$(this).val().trim()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return isValid;
            };

            // Remove validation errors on input
            $(document).on('input', '.form-control', function() {
                $(this).removeClass('is-invalid');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
