<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\Pages\Product\Index as ProductIndex;
use App\Livewire\Admin\Pages\Users\Edit;
use App\Livewire\Admin\Pages\Users\Show;
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

        //categories
        Route::get('/admin/category', function () {
            return view('admin.pages.category.index');
        })->name('admin.category.index');
        Route::get('/admin/category/create', function () {
            return view('admin.pages.category.create');
        })->name('admin.category.create');
        Route::get('/admin/category/{id}/edit', function () {
            return view('admin.pages.category.edit');
        })->name('admin.category.edit');

        //Brand
        Route::get('/admin/brand', function () {
            return view('admin.pages.brand.index');
        })->name('admin.brand.index');
        Route::get('/admin/brand/create', function () {
            return view('admin.pages.brand.create');
        })->name('admin.brand.create');
        Route::get('/admin/brand/{id}/edit', function () {
            return view('admin.pages.brand.edit');
        })->name('admin.brand.edit');

        //Attribute
        Route::get('/admin/attribute', function () {
            return view('admin.pages.attribute.index');
        })->name('admin.attribute.index');
        Route::get('/admin/attribute/create', function () {
            return view('admin.pages.attribute.create');
        })->name('admin.attribute.create');
        Route::get('/admin/attribute/{id}/edit', function () {
            return view('admin.pages.attribute.edit');
        })->name('admin.attribute.edit');

        //Supplier
        Route::get('/admin/supplier', function () {
            return view('admin.pages.supplier.index');
        })->name('admin.supplier.index');
        Route::get('/admin/supplier/create', function () {
            return view('admin.pages.supplier.create');
        })->name('admin.supplier.create');
        Route::get('/admin/supplier/{id}/edit', function () {
            return view('admin.pages.supplier.edit');
        })->name('admin.supplier.edit');

        //Admin profile
        Route::get('/admin/user', function () {
            return view('admin.pages.user.index');
        })->name('admin.user.index');
        Route::get('/admin/user/edit', function () {
            return view('admin.pages.user.edit');
        })->name('admin.user.edit');

        //Users
        Route::get('/admin/users', function () {
            return view('admin.pages.users.index');
        })->name('admin.users.index');
        Route::get('/admin/users/create', function () {
            return view('admin.pages.users.create');
        })->name('admin.users.create');
        Route::get('/admin/users/{id}/edit', function ($id) {
            return view('admin.pages.users.edit', ['id' => $id]);
        })->name('admin.users.edit');
        // Route::get('/admin/users/{id}/edit', Edit::class)->name('admin.users.edit');
        Route::get('/admin/users/{id}', function ($id) {
            return view('admin.pages.users.show', ['id' => $id]);
        })->name('admin.users.show');

        //Coupon
        Route::get('/admin/coupon', function () {
            return view('admin.pages.coupon.index');
        })->name('admin.coupon.index');
        Route::get('/admin/coupon/create', function () {
            return view('admin.pages.coupon.create');
        })->name('admin.coupon.create');
        Route::get('/admin/coupon/{id}/edit', function () {
            return view('admin.pages.coupon.edit');
        })->name('admin.coupon.edit');

        //Cart
        Route::get('/admin/cart', function () {
            return view('admin.pages.cart.index');
        })->name('admin.cart.index');
        Route::get('/admin/cart/create', function () {
            return view('admin.pages.cart.create');
        })->name('admin.cart.create');
        Route::get('/admin/cart/{id}/edit', function () {
            return view('admin.pages.cart.edit');
        })->name('admin.cart.edit');

        //Order
        Route::get('/admin/order', function () {
            return view('admin.pages.order.index');
        })->name('admin.order.index');
        Route::get('/admin/order/create', function () {
            return view('admin.pages.order.create');
        })->name('admin.order.create');
        Route::get('/admin/order/{id}/edit', function () {
            return view('admin.pages.order.edit');
        })->name('admin.order.edit');

        //Payment
        Route::get('/admin/payment', function () {
            return view('admin.pages.payment.index');
        })->name('admin.payment.index');
        Route::get('/admin/payment/{id}/edit', function () {
            return view('admin.pages.payment.edit');
        })->name('admin.payment.edit');
        Route::get('/admin/payment/create', function () {
            return view('admin.pages.payment.create');
        })->name('admin.payment.create');

        //Shipping
        Route::get('/admin/shipping', function () {
            return view('admin.pages.shipping.index');
        })->name('admin.shipping.index');
        Route::get('/admin/shipping/{id}/edit', function () {
            return view('admin.pages.shipping.edit');
        })->name('admin.shipping.edit');
        Route::get('/admin/shipping/create', function () {
            return view('admin.pages.shipping.create');
        })->name('admin.shipping.create');

        //Setting
        Route::get('/admin/setting', function () {
            return view('admin.pages.setting.index');
        })->name('admin.setting.index');
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
