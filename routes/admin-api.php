<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminApi\AuthController;

Route::middleware(['throttle'])->group(function() {
    Route::post('login', [AuthController::class, 'loginUser']);
    Route::post('register', [AuthController::class, 'registerUser']);
    Route::get('logout', [AuthController::class, 'logoutUser']);
});

Route::middleware(['admin'])->group(function() {
    Route::get('user', [AuthController::class, 'currentUser']);

    Route::apiResource('products', ProductController::class)
        ->only(['index', 'show', 'store', 'destroy']);

    Route::apiResource('categories', CategoryController::class)
        ->only(['index', 'store']);

    Route::apiResource('videos', VideoController::class)
        ->only(['index']);
});
