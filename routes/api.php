<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/categories', [ProductController::class, 'categories']);
    Route::get('/{product}', [ProductController::class, 'show']);
});

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {

    // Cart routes
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'add']);
        Route::patch('/{productId}', [CartController::class, 'update']);
        Route::delete('/{productId}', [CartController::class, 'remove']);
        Route::delete('/', [CartController::class, 'clear']);
        Route::get('/summary', [CartController::class, 'summary']);
    });

    // Order routes
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::patch('/{order}/status', [OrderController::class, 'updateStatus']);
        Route::post('/{order}/cancel', [OrderController::class, 'cancel']);
    });

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            // Product management
            Route::prefix('products')->group(function () {
                Route::post('/', [ProductController::class, 'store']);
                Route::put('/{product}', [ProductController::class, 'update']);
                Route::delete('/{product}', [ProductController::class, 'destroy']);
                Route::get('/low-stock', [ProductController::class, 'lowStock']);
            });

            // Order management
            Route::prefix('orders')->group(function () {
                Route::get('/statistics', [OrderController::class, 'statistics']);
            });
        });
    });
});

