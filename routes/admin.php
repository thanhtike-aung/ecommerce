<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;

// Admin Dashboard Route
Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->name('admin.dashboard');

// Admin Brand Routes
Route::middleware(['admin'])->prefix('brand')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::post('/', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::delete('/delete/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
});

// Admin Category Routes
Route::middleware(['admin'])->prefix('category')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.category.index');
    })->name('admin.category.index');
    Route::get('/create', function () {
        return view('pages.admin.category.create');
    })->name('admin.category.create');
});

// Admin Product Routes
Route::middleware(['admin'])->prefix('product')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.product.index');
    })->name('admin.product.index');
    Route::get('/create', function () {
        return view('pages.admin.product.create');
    })->name('admin.product.create');
    Route::get('/reviews', function () {
        return view('pages.admin.product.reviews');
    })->name('admin.product.reviews');
});

// Admin Customer Routes
Route::middleware(['admin'])->prefix('customer')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.customer.index');
    })->name('admin.customer.index');
});

// Admin Order Routes
Route::middleware(['admin'])->prefix('order')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.order.index');
    })->name('admin.order.index');
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
