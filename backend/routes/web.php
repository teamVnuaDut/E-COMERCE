<?php

use App\Http\Controllers\Auth\AuthController;
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

    //Dashboard route
    Route::get('dashboard', 'dashboard')->name('dashboard')->middleware('auth');
});
