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
    Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
});
