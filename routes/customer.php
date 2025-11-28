<?php

use App\Http\Controllers\Customer\BrandController as CustomerBrandController;
use App\Http\Controllers\Customer\CategoryController as CustomerCategoryController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use Illuminate\Support\Facades\Route;

// Brand Routes
Route::prefix('brands')->group(function () {
    Route::get('/', [CustomerBrandController::class, 'index'])->name('customer.brands.index');
    Route::get('/{brand}', [CustomerBrandController::class, 'show'])->name('customer.brands.show');
    Route::get('/api/brands', [CustomerBrandController::class, 'getBrands'])->name('customer.brands.api');
    Route::get('/api/featured', [CustomerBrandController::class, 'getFeaturedBrands'])->name('customer.brands.featured');
});

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CustomerCategoryController::class, 'index'])->name('customer.categories.index');
    Route::get('/{category}', [CustomerCategoryController::class, 'show'])->name('customer.categories.show');
    Route::get('/slug/{slug}', [CustomerCategoryController::class, 'showBySlug'])->name('customer.categories.show_by_slug');
    Route::get('/api/categories', [CustomerCategoryController::class, 'getCategories'])->name('customer.categories.api');
    Route::get('/api/tree', [CustomerCategoryController::class, 'getCategoryTree'])->name('customer.categories.tree');
});

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [CustomerProductController::class, 'index'])->name('customer.products.index');
    Route::get('/{product}', [CustomerProductController::class, 'show'])->name('customer.products.show');
    Route::get('/category/{categoryId}', [CustomerProductController::class, 'byCategory'])->name('customer.products.by_category');
    Route::get('/brand/{brandId}', [CustomerProductController::class, 'byBrand'])->name('customer.products.by_brand');
    Route::get('/api/products', [CustomerProductController::class, 'getProducts'])->name('customer.products.api');
    Route::get('/api/featured', [CustomerProductController::class, 'getFeaturedProducts'])->name('customer.products.featured');
    Route::get('/api/new-arrivals', [CustomerProductController::class, 'getNewArrivals'])->name('customer.products.new_arrivals');
});

// Customer Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['customer'])->name('customer.dashboard');

// User Profile Routes
Route::middleware(['customer'])->group(function () {
    Route::get('profile', function() {
        return view('pages.customer.profile.show');
    })->name('customer.profile.show');

    Route::get('orders', function() {
        return view('pages.customer.orders.index');
    })->name('customer.orders.index');

    Route::get('wishlist', function() {
        return view('pages.customer.wishlist.index');
    })->name('customer.wishlist.index');
});
