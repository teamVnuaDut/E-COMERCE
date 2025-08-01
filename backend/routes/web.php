<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
