<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->middleware('throttle:5,1');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('sliders', SliderController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('events', EventController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class);
});
