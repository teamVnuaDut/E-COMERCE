<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // public function register()
    // {
    //     if ($this->app->environment('local')) {
    //         $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
    //         // Tắt middleware không cần thiết
    //         // $this->app->make('Illuminate\Contracts\Http\Kernel')
    //         //     ->pushMiddleware(\App\Http\Middleware\TrustProxies::class);
    //     }
    // }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     Route::matched(function ($route, $request) {
    //         if (
    //             !Auth::check() &&
    //             !$request->is('login') &&
    //             !$request->is('logout') &&
    //             !$request->is('register') &&
    //             !$request->is('password/*') &&
    //             !$request->is('email/verify/*') &&
    //             !$request->is('sanctum/csrf-cookie')
    //         ) {
    //             return redirect()->route('login');
    //         }
    //     });
    // }
}
