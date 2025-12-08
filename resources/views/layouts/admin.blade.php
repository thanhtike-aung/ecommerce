<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard - Nexwear')</title>

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

        /* Sidebar Styles */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            width: 280px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
        }

        #sidebar ul.components {
            padding: 20px 0;
            overflow-y: auto;
        }

        #sidebar ul p {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #333;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1em;
            display: flex;
            align-items: center;
            color: #555;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        #sidebar ul li a:hover {
            background: #f8f9fa;
            color: #667eea;
            border-left: 4px solid #667eea;
        }

        #sidebar ul li a.active {
            background: #f1f5ff;
            color: #667eea;
            border-left: 4px solid #667eea;
        }

        #sidebar ul li a i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        #sidebar .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #f1f1f1;
            margin-top: auto;
        }

        #content {
            width: calc(100% - 280px);
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        #content.expanded {
            width: calc(100% - 80px);
        }

        .submenu {
            margin-left: 20px;
        }

        /* Top Navigation */
        .top-navbar {
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -280px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                width: 100%;
            }
            #content.active {
                width: calc(100% - 280px);
            }
            #sidebarCollapse span {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
                    <i class="bi bi-shop text-primary me-4"></i>
                    <span class="fs-4 fw-bold">Nexwear Management</span>
                </a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.brand.index') }}" class="{{ request()->routeIs('admin.brand.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i>
                        <span>Brands</span>
                    </a>
                </li>
                <li>
                    <a href="#categoriesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="collapse list-unstyled submenu" id="categoriesSubmenu">
                        <li>
                            <a href="{{ route('admin.category.index') }}"><i class="bi bi-circle"></i> All Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.create') }}"><i class="bi bi-plus-circle"></i> Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#productsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i>
                        <span>Products</span>
                    </a>
                    <ul class="collapse list-unstyled submenu" id="productsSubmenu">
                        <li>
                            <a href="{{ route('admin.product.index') }}"><i class="bi bi-circle"></i> All Products</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.create') }}"><i class="bi bi-plus-circle"></i> Add New</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.reviews') }}"><i class="bi bi-star"></i> Reviews</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.customer.index') }}" class="{{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.order.index') }}" class="{{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                        <i class="bi bi-cart3"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="#settingsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        <span>System Settings</span>
                    </a>
                    <ul class="collapse list-unstyled submenu" id="settingsSubmenu">
                        <li>
                            <a href="{{ route('admin.settings.general') }}"><i class="bi bi-circle"></i> General</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.payment') }}"><i class="bi bi-circle"></i> Payment Methods</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.shipping') }}"><i class="bi bi-circle"></i> Shipping</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.email') }}"><i class="bi bi-circle"></i> Email Templates</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                            <span>{{ auth()->user() ? substr(auth()->user()->name, 0, 1) : 'A' }}</span>
                        </div>
                        <div>
                            <div class="fw-bold">{{ auth()->user() ? auth()->user()->name : 'Admin' }}</div>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navigation -->
            <div class="top-navbar mb-4">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="bi bi-list"></i>
                </button>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <button class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">New order received</a></li>
                            <li><a class="dropdown-item" href="#">Product out of stock</a></li>
                            <li><a class="dropdown-item" href="#">New customer registered</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('collapsed');
                $('#content').toggleClass('expanded');

                // Hide/show text in sidebar
                if ($('#sidebar').hasClass('collapsed')) {
                    $('#sidebar .sidebar-header span').hide();
                    $('#sidebar ul li a span').hide();
                    $('.submenu').removeClass('show');
                    $('.sidebar-footer').hide();
                } else {
                    $('#sidebar .sidebar-header span').show();
                    $('#sidebar ul li a span').show();
                    $('.sidebar-footer').show();
                }
            });

            // Toast container is already in the HTML
        });

        // Global utility functions
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

            const $toast = $(toastHtml);
            $('#toast-container').append($toast);

            const toast = new bootstrap.Toast($toast[0], {
                autohide: true,
                delay: 3000
            });

            toast.show();

            // Remove toast from DOM after it's hidden
            $toast.on('hidden.bs.toast', function() {
                $(this).remove();
            });
        };
    </script>

    @stack('scripts')
</body>
</html>
