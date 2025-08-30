<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth routes - chỉ cho guest
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show.login');
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/forgot-password', 'showForgotPassword')->name('show.forgot.password');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');

    // Route đặt lại mật khẩu
    Route::get('/reset-password/{token}', 'showResetPassword')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});

// Logout - chỉ cho authenticated users
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard routes - cần auth, admin role và kiểm tra user status
Route::middleware(['auth'])->controller(AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
        Route::get('/overview', 'overview')->name('admin.overview');
        Route::get('/products', 'products')->name('admin.products');
        Route::get('/orders', 'orders')->name('admin.orders');
        Route::get('/customers', 'customers')->name('admin.customers');
        Route::get('/reports', 'reports')->name('admin.reports');
        Route::get('/user', 'user')->name('admin.user');
        Route::get('/settings', 'settings')->name('admin.settings');

        // API routes cho admin (nếu cần)
        Route::prefix('api')->group(function () {
            Route::get('/stats', 'getStats')->name('admin.api.stats');
            Route::get('/recent-activity', 'getRecentActivity')->name('admin.api.activity');
        });
    });
});

// User routes (sau khi đăng nhập) - cần auth và kiểm tra user status
Route::middleware(['auth'])->controller(UserController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('user.dashboard');
    Route::get('/profile', 'profile')->name('user.profile');
    // ... other user routes
});
