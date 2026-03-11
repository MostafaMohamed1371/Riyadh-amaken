<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Public: no token required
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected: require Authorization: Bearer {token}
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

    Route::apiResource('sliders', SliderController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('gallery', GalleryController::class);
    Route::apiResource('activities', ActivityController::class);
    Route::apiResource('events', EventController::class);

    Route::get('settings', [SettingController::class, 'index']);
    Route::put('settings', [SettingController::class, 'update']);

    Route::apiResource('users', UserController::class);
});
