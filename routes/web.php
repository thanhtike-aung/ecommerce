<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Customer\BrandController as CustomerBrandController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Brand Routes
Route::prefix('admin/brand')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::post('/', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
});

// Customer Brand Routes
Route::prefix('brands')->group(function () {
    Route::get('/', [CustomerBrandController::class, 'index'])->name('customer.brands.index');
    Route::get('/{brand}', [CustomerBrandController::class, 'show'])->name('customer.brands.show');
    Route::get('/api/brands', [CustomerBrandController::class, 'getBrands'])->name('customer.brands.api');
    Route::get('/api/featured', [CustomerBrandController::class, 'getFeaturedBrands'])->name('customer.brands.featured');
});

require __DIR__.'/auth.php';
