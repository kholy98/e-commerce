<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CheckoutController;
use App\Services\SessionCartService;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::post('/register', function (Request $request, SessionCartService $cartService) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Migrate guest cart to user cart after authentication
    Auth::login($user);
    $cartService->migrateSessionToDatabase();
    Auth::logout();

    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
});

Route::post('/login', function (Request $request, SessionCartService $cartService) {
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    $user = Auth::user();
    
    // Migrate guest cart to user cart
    $cartService->migrateSessionToDatabase();
    
    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out successfully',
    ]);
})->middleware('auth:sanctum');

// Public routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/categories', [ProductController::class, 'categories']);
    Route::get('/{product}', [ProductController::class, 'show']);
});

// Cart routes - now public for both guest and authenticated users
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/add', [CartController::class, 'add']);
    Route::patch('/{productId}', [CartController::class, 'update']);
    Route::delete('/{productId}', [CartController::class, 'remove']);
    Route::delete('/', [CartController::class, 'clear']);
    Route::get('/summary', [CartController::class, 'summary']);
    Route::get('/count', [CartController::class, 'count']);
});

// Checkout routes - public for guest checkout, but can be used by authenticated users too
Route::prefix('checkout')->group(function () {
    Route::post('/initiate', [CheckoutController::class, 'initiate']);
    Route::post('/complete', [CheckoutController::class, 'complete']);
    Route::post('/fail', [CheckoutController::class, 'fail']);
    Route::get('/status', [CheckoutController::class, 'status']);
});

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {

    // Order routes
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::patch('/{order}/status', [OrderController::class, 'updateStatus']);
        Route::post('/{order}/cancel', [OrderController::class, 'cancel']);
    });

    // Admin routes
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

// Payment routes
Route::post('/payment/process', [PaymentController::class, 'paymentProcess']);
Route::match(['GET','POST'],'/payment/callback', [PaymentController::class, 'callBack']);
Route::post('/payment/webhook', [PaymentController::class, 'webhook']);

// Shipment routes
Route::post('/shipments', [ShipmentController::class, 'create']);
Route::get('/shipments/{tracking_number}', [ShipmentController::class, 'track']);
Route::put('/shipments/{tracking_number}', [ShipmentController::class, 'update']);
Route::post('/pickups', [ShipmentController::class, 'createPickup']);
Route::post('/webhook/bosta', [App\Http\Controllers\BostaWebhookController::class, 'handle']);

