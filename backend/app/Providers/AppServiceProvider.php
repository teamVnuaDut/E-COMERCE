<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Add custom helper method to get authenticated user data
        app()->macro('getDataUser', function () {
            return Auth::user();
        });
        
        // Add custom helper method to check if user is authenticated
        app()->macro('isUserAuthenticated', function () {
            return Auth::check();
        });
        
        // Add custom helper method to get user ID
        app()->macro('getUserId', function () {
            return Auth::id();
        });
    }
}
