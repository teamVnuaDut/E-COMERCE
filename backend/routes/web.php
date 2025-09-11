<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\Pages\Product\Index as ProductIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::controller(AuthController::class)->group(function () {
    //authentication route
    Route::get('login', 'index')->name('login');
    Route::post('login', 'postLogin')->name('login.post');
    Route::get('register', 'registration')->name('register');
    Route::post('register', 'postRegistration')->name('register.post');
    Route::post('logout', 'logout')->name('logout');
});

// Admin
Route::middleware(['auth', 'check_role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        //product
        Route::get('/admin/products', function () {
            return view('admin.pages.products.index');
        })->name('admin.product.index');
        Route::get('/admin/products/create', function () {
            return view('admin.pages.products.create');
        })->name('admin.product.create');
        Route::get('/admin/products/{id}/edit', function () {
            return view('admin.pages.products.edit');
        })->name('admin.product.edit');
    });

// Manager
Route::middleware(['auth', 'check_role:manager'])
    ->prefix('manager')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('manager.dashboard');
    });

// Staff
Route::middleware(['auth', 'check_role:staff'])
    ->prefix('staff')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('staff.dashboard');
    });

// Customer
Route::middleware(['auth', 'check_role:customer'])
    ->prefix('customer')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('customer.dashboard');
    });
