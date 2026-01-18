<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TeamMemberApiController;
use App\Models\User;
use App\Services\SessionCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

    if (! Auth::attempt($request->only('email', 'password'))) {
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
    // Route::get('/categories', [ProductController::class, 'categories']);
    Route::get('/{product}', [ProductController::class, 'show']);
});

// Public category routes for API testing
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'publicIndex']);
    Route::get('/{category}', [CategoryController::class, 'publicShow']);
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
    Route::match(['GET', 'POST'], '/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
    Route::match(['GET', 'POST'], '/fail', [CheckoutController::class, 'fail'])->name('checkout.fail');
    Route::get('/status', [CheckoutController::class, 'status']);
    Route::post('/test-complete', [CheckoutController::class, 'testComplete']);
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
});

// Admin routes - use session auth instead of Sanctum
Route::middleware(['web', 'auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard/stats', [\App\Http\Controllers\DashboardController::class, 'stats']);
    Route::get('/dashboard/products', [\App\Http\Controllers\DashboardController::class, 'recentProducts']);
    Route::get('/dashboard/categories', [\App\Http\Controllers\DashboardController::class, 'categories']);

    // Product management
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
        Route::get('/low-stock', [ProductController::class, 'lowStock']);
    });

    // Category management
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });

    // Order management
    Route::prefix('orders')->group(function () {
        Route::get('/statistics', [OrderController::class, 'statistics']);
    });
});

// Team member API routes - public for now to return JSON
Route::prefix('admin/team-members')->group(function () {
    Route::get('/', [TeamMemberApiController::class, 'index']);
    Route::get('/{teamMember}', [TeamMemberApiController::class, 'show']);
});


// Contact Inquiries API routes
Route::get('contact-inquiries', [ContactInquiryController::class, 'index'])->name('api.contact-inquiries.index');
Route::post('contact-inquiries', [ContactInquiryController::class, 'store'])->name('api.contact-inquiries.store');
Route::get('contact-inquiries/{inquiry}', [ContactInquiryController::class, 'show'])->name('api.contact-inquiries.show');
Route::put('contact-inquiries/{inquiry}', [ContactInquiryController::class, 'update'])->name('api.contact-inquiries.update');
Route::patch('contact-inquiries/{inquiry}', [ContactInquiryController::class, 'patch'])->name('api.contact-inquiries.patch');
Route::post('contact-inquiries/{inquiry}/reply', [ContactInquiryController::class, 'reply'])->name('api.contact-inquiries.reply');
Route::delete('contact-inquiries/{inquiry}', [ContactInquiryController::class, 'destroy'])->name('api.contact-inquiries.destroy');


// Payment routes
Route::post('/payment/process', [PaymentController::class, 'paymentProcess']);
Route::match(['GET', 'POST'], '/payment/callback', [PaymentController::class, 'callBack']);
Route::post('/payment/webhook', [PaymentController::class, 'webhook']);

// Shipment routes
Route::post('/shipments', [ShipmentController::class, 'create']);
Route::get('/shipments/{tracking_number}', [ShipmentController::class, 'track']);
Route::put('/shipments/{tracking_number}', [ShipmentController::class, 'update']);
Route::post('/pickups', [ShipmentController::class, 'createPickup']);
Route::post('/webhook/bosta', [App\Http\Controllers\BostaWebhookController::class, 'handle']);
Route::post('/test/webhook/bosta', [App\Http\Controllers\BostaWebhookController::class, 'testWebhook']);

Route::post('/settings/env', [ConfigController::class, 'updateEnv']);

Route::get('/settings/env/debug', [ConfigController::class, 'showEnvStatus']);
