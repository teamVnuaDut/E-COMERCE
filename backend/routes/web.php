<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RecentActivityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;

// Auth routes - chỉ cho guest
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegister')->name('register');
    Route::get('/forgot-password', 'showForgotPassword')->name('password.request');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/login', 'login')->name('login.post');

    // Route đặt lại mật khẩu
    Route::get('/reset-password/{token}', 'showResetPassword')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showVerifyEmail'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->middleware(['throttle:6,1'])->name('verification.send');
});

// Logout - chỉ cho authenticated users
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public routes (không cần auth)
Route::get('/', [ProductsController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'catalog'])->name('products.catalog');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/categories/{slug}', [CategoriesController::class, 'show'])->name('categories.show');

// Customer routes (sau khi đăng nhập) - cần auth và verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UsersController::class, 'updateProfile'])->name('user.profile.update');

    // Cart and Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    // Orders
    Route::get('/orders', [OrdersController::class, 'index'])->name('user.orders');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('user.orders.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Admin Dashboard routes - cần auth, verified và role admin
Route::middleware(['auth', 'verified', 'role:admin,manager'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/overview', [OverviewController::class, 'index'])->name('admin.overview');

    // Products routes - Sử dụng resource
    Route::resource('/products', ProductController::class)->except(['show']);
    Route::post('/products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('admin.products.update-stock');
    Route::post('/products/{product}/update-price', [ProductController::class, 'updatePrice'])->name('admin.products.update-price');

    // Categories routes - Sử dụng resource
    Route::resource('/categories', CategoryController::class)->except(['show']);

    // Brands routes
    Route::resource('/brands', BrandController::class)->except(['show']);

    // Customers routes
    Route::resource('/customers', CustomerController::class);
    Route::get('/customers/{customer}/orders', [CustomerController::class, 'orders'])->name('admin.customers.orders');
    Route::post('/customers/{customer}/update-status', [CustomerController::class, 'updateStatus'])->name('admin.customers.update-status');

    // Orders routes
    Route::resource('/orders', OrderController::class)->except(['create', 'store']);
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::post('/orders/{order}/update-payment', [OrderController::class, 'updatePaymentStatus'])->name('admin.orders.update-payment');

    // Warehouse routes
    Route::resource('/warehouses', WarehouseController::class);
    Route::get('/warehouses/{warehouse}/inventory', [WarehouseController::class, 'inventory'])->name('admin.warehouses.inventory');
    Route::post('/warehouses/{warehouse}/adjust-inventory', [WarehouseController::class, 'adjustInventory'])->name('admin.warehouses.adjust-inventory');

    // Inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
    Route::get('/inventory/low-stock', [InventoryController::class, 'lowStock'])->name('admin.inventory.low-stock');
    Route::get('/inventory/expiring', [InventoryController::class, 'expiring'])->name('admin.inventory.expiring');

    // Promotions routes
    Route::resource('/promotions', PromotionController::class);

    // Reports routes
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('admin.reports.sales');
    Route::get('/reports/inventory', [ReportController::class, 'inventory'])->name('admin.reports.inventory');
    Route::get('/reports/customers', [ReportController::class, 'customers'])->name('admin.reports.customers');

    // Users management (chỉ admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('/users', UserController::class);
        Route::post('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('admin.users.update-role');
        Route::post('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('admin.users.update-status');
    });

    // Settings routes
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings/general', [SettingController::class, 'updateGeneral'])->name('admin.settings.general');
    Route::post('/settings/payment', [SettingController::class, 'updatePayment'])->name('admin.settings.payment');
    Route::post('/settings/shipping', [SettingController::class, 'updateShipping'])->name('admin.settings.shipping');

    // API routes cho admin
    Route::prefix('api')->group(function () {
        Route::get('/stats', [StatController::class, 'getStats'])->name('admin.api.stats');
        Route::get('/recent-activity', [RecentActivityController::class, 'getRecentActivity'])->name('admin.api.activity');
        Route::get('/sales-data', [StatController::class, 'getSalesData'])->name('admin.api.sales-data');
        Route::get('/inventory-alerts', [StatController::class, 'getInventoryAlerts'])->name('admin.api.inventory-alerts');
    });
});

// Staff routes (nhân viên) - cần auth, verified và role staff
Route::middleware(['auth', 'verified', 'role:staff'])->prefix('staff')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');

    // Orders management for staff
    Route::get('/orders', [StaffOrderController::class, 'index'])->name('staff.orders.index');
    Route::get('/orders/{order}', [StaffOrderController::class, 'show'])->name('staff.orders.show');
    Route::post('/orders/{order}/update-status', [StaffOrderController::class, 'updateStatus'])->name('staff.orders.update-status');

    // Customers management for staff
    Route::get('/customers', [StaffCustomerController::class, 'index'])->name('staff.customers.index');
    Route::get('/customers/{customer}', [StaffCustomerController::class, 'show'])->name('staff.customers.show');

    // Inventory view for staff
    Route::get('/inventory', [StaffInventoryController::class, 'index'])->name('staff.inventory.index');
});

// Fallback route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
