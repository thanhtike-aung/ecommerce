<?php

use App\Http\Controllers\Customer\BrandController as CustomerBrandController;
use Illuminate\Support\Facades\Route;

// Brand Routes
Route::prefix('brands')->group(function () {
    Route::get('/', [CustomerBrandController::class, 'index'])->name('customer.brands.index');
    Route::get('/{brand}', [CustomerBrandController::class, 'show'])->name('customer.brands.show');
    Route::get('/api/brands', [CustomerBrandController::class, 'getBrands'])->name('customer.brands.api');
    Route::get('/api/featured', [CustomerBrandController::class, 'getFeaturedBrands'])->name('customer.brands.featured');
});

// Customer Dashboard Route
Route::get('/dashboard', function () {
    return view('pages.customer.dashboard');
})->middleware(['customer'])->name('customer.dashboard');

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
