<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

// Admin Login Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest:admin')
    ->name('admin.login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest:admin')
    ->name('admin.login');

// Admin Password Reset Routes
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest:admin')
    ->name('admin.password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest:admin')
    ->name('admin.password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest:admin')
    ->name('admin.password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest:admin')
    ->name('admin.password.store');

// Admin Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('admin.logout');
