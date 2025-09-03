<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RecentActivityController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UsersController;
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
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/overview', [OverviewController::class, 'overview'])->name('admin.overview');

        //product route
        Route::get('/products', [ProductsController::class, 'products'])->name('admin.products');
        Route::get('/products/create', [ProductsController::class, 'create'])->name('admin.product.create');
        Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('admin.product.edit');
        Route::delete('/products/destroy', [ProductsController::class, 'destroy'])->name('admin.product.destroy');

        //Route categories
        Route::get('/categories', [CategoriesController::class, 'categories'])->name('admin.categories');
        Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.category.create');
        Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('admin.category.edit');
        Route::delete('/categories/destroy', [CategoriesController::class, 'destroy'])->name('admin.category.destroy');

        Route::get('/orders', [OrdersController::class, 'orders'])->name('admin.orders');
        Route::get('/customers', [CustomersController::class, 'customers'])->name('admin.customers');
        Route::get('/reports', [ReportsController::class, 'reports'])->name('admin.reports');
        Route::get('/user', [UsersController::class, 'user'])->name('admin.user');
        Route::get('/settings', [SettingsController::class, 'settings'])->name('admin.settings');

        // API routes cho admin (nếu cần)
        Route::prefix('api')->group(function () {
            Route::get('/stats', [StatsController::class, 'getStats'])->name('admin.api.stats');
            Route::get('/recent-activity', [RecentActivityController::class, 'getRecentActivity'])->name('admin.api.activity');
        });
    });
});

// User routes (sau khi đăng nhập) - cần auth và kiểm tra user status
Route::middleware(['auth'])->controller(UsersController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('user.dashboard');
    Route::get('/profile', 'profile')->name('user.profile');
    // ... other user routes
});
