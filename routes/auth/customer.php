<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Customer Registration Routes
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest:customer')
    ->name('customer.register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest:customer')
    ->name('customer.register');

// Customer Login Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest:customer')
    ->name('customer.login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest:customer')
    ->name('customer.login');

// Customer Password Reset Routes
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest:customer')
    ->name('customer.password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest:customer')
    ->name('customer.password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest:customer')
    ->name('customer.password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest:customer')
    ->name('customer.password.store');

// Customer Email Verification Routes
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth:customer', 'signed', 'throttle:6,1'])
    ->name('customer.verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:customer', 'throttle:6,1'])
    ->name('customer.verification.send');

// Customer Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:customer')
    ->name('customer.logout');
