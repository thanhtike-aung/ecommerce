<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Admin Dashboard Route
use App\Http\Controllers\Admin\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Admin Brand Routes
Route::middleware(['admin'])->prefix('brand')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::get('/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::post('/', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::post('/delete/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
    Route::get('/{brand}', [BrandController::class, 'show'])->name('admin.brand.show');
});

// Admin Category Routes
Route::middleware(['admin'])->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::post('/delete/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
});

// Admin Product Routes
Route::middleware(['admin'])->prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::post('/delete/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/{product}', [ProductController::class, 'show'])->name('admin.product.show');

    // Product Reviews
    Route::get('/reviews', [ProductController::class, 'reviews'])->name('admin.product.reviews');
    Route::post('/reviews/{id}/status', [ProductController::class, 'updateReviewStatus'])->name('admin.product.reviews.status');
    Route::post('/reviews/{id}/delete', [ProductController::class, 'deleteReview'])->name('admin.product.reviews.delete');
});

// Admin Customer Routes
Route::middleware(['admin'])->prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('admin.customer.create');
    Route::post('/', [CustomerController::class, 'store'])->name('admin.customer.store');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('admin.customer.update');
    Route::post('/delete/{customer}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');
    Route::get('/{customer}', [CustomerController::class, 'show'])->name('admin.customer.show');
});

// Admin Order Routes
Route::middleware(['admin'])->prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/create', [OrderController::class, 'create'])->name('admin.order.create');
    Route::post('/', [OrderController::class, 'store'])->name('admin.order.store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
    Route::put('/{order}', [OrderController::class, 'update'])->name('admin.order.update');
    Route::post('/delete/{order}', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::post('/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.order.status');
    Route::post('/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('admin.order.payment-status');
});

// Admin Settings Routes
Route::middleware(['admin'])->prefix('settings')->group(function () {
    Route::get('/general', function () {
        return view('pages.admin.settings.general');
    })->name('admin.settings.general');
    Route::get('/payment', function () {
        return view('pages.admin.settings.payment');
    })->name('admin.settings.payment');
    Route::get('/shipping', function () {
        return view('pages.admin.settings.shipping');
    })->name('admin.settings.shipping');
    Route::get('/email', function () {
        return view('pages.admin.settings.email');
    })->name('admin.settings.email');
});
