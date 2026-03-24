<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TeamMemberApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\User;
use App\Services\SessionCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// User management routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);
});

/**
 * @group Authentication
 *
 * Register a new user
 *
 * Create a new user account and receive an API token.
 * If the user has items in their guest cart, they will be migrated to the new account.
 *
 * @unauthenticated
 *
 * @bodyParam name string required The user's full name. Example: John Doe
 * @bodyParam email string required The user's email address (must be unique). Example: john@example.com
 * @bodyParam password string required The password (minimum 8 characters). Example: password123
 * @bodyParam password_confirmation string required Password confirmation (must match password). Example: password123
 * @bodyParam phone string optional The user's phone number. Example: +1234567890
 *
 * @response 200 scenario="Success" {
 *   "user": {
 *     "id": 1,
 *     "name": "John Doe",
 *     "email": "john@example.com",
 *     "updated_at": "2024-01-15T10:00:00.000000Z",
 *     "created_at": "2024-01-15T10:00:00.000000Z",
 *     "addresses": [
 *       {
 *         "id": 1,
 *         "user_id": 1,
 *         "label": "Home",
 *         "name": "John Doe",
 *         "phone": "+1234567890",
 *         "address": "123 Main St, Cairo, Egypt",
 *         "street": "123 Main St",
 *         "building_number": "15",
 *         "floor": "3",
 *         "apartment": "5A",
 *         "zone": "Maadi",
 *         "city": "Cairo",
 *         "zip_code": "12345",
 *         "country": "Egypt",
 *         "state": "Cairo",
 *         "is_default": true,
 *         "is_billing": true,
 *         "is_shipping": true,
 *         "created_at": "2024-01-15T10:00:00.000000Z",
 *         "updated_at": "2024-01-15T10:00:00.000000Z"
 *       }
 *     ]
 *   },
 *   "token": "1|abc123def456..."
 * }
 * @response 422 scenario="Validation Error" {
 *   "message": "The email has already been taken.",
 *   "errors": {
 *     "email": ["The email has already been taken."]
 *   }
 * }
 */
Route::post('/register', function (Request $request, SessionCartService $cartService) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'nullable|string|max:20',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    // Migrate guest cart to user cart after authentication
    Auth::login($user);
    $cartService->migrateSessionToDatabase();
    Auth::logout();

    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'user' => $user->load(['addresses' => function ($query) {
            $query->orderBy('is_default', 'desc')->orderBy('created_at', 'desc');
        }]),
        'token' => $token,
    ]);
});

/**
 * @group Authentication
 *
 * Login
 *
 * Authenticate a user and receive an API token.
 * If the user has items in their guest cart, they will be migrated to their account.
 *
 * @unauthenticated
 *
 * @bodyParam email string required The user's email address. Example: john@example.com
 * @bodyParam password string required The user's password. Example: password123
 *
 * @response 200 scenario="Success" {
 *   "user": {
 *     "id": 1,
 *     "name": "John Doe",
 *     "email": "john@example.com",
 *     "email_verified_at": "2024-01-15T10:00:00.000000Z",
 *     "created_at": "2024-01-15T10:00:00.000000Z",
 *     "updated_at": "2024-01-15T10:00:00.000000Z"
 *   },
 *   "token": "1|abc123def456..."
 * }
 * @response 401 scenario="Invalid Credentials" {
 *   "message": "Invalid credentials"
 * }
 * @response 422 scenario="Validation Error" {
 *   "message": "The email field is required.",
 *   "errors": {
 *     "email": ["The email field is required."]
 *   }
 * }
 */
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
        'user' => $user->load(['addresses' => function ($query) {
            $query->orderBy('is_default', 'desc')->orderBy('created_at', 'desc');
        }]),
        'token' => $token,
    ]);
});

/**
 * @group Authentication
 *
 * Logout
 *
 * Invalidate the current API token and log out the user.
 *
 * @authenticated
 *
 * @response 200 scenario="Success" {
 *   "message": "Logged out successfully"
 * }
 * @response 401 scenario="Unauthenticated" {
 *   "message": "Unauthenticated."
 * }
 */
Route::post('/logout', function (Request $request) {
    $user = $request->user();

    // 1. Delete ALL tokens for this user (Permanent Logout from all devices)
    $user->tokens()->delete();

    // 2. Force the Session to be destroyed (If any exists)
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 3. Clear the Laravel Authentication Cookie manually
    // This is the 'secret' to stopping /api/user from working immediately
    $cookie = Cookie::forget('laravel_session');

    return response()->json([
        'message' => 'Every token and session has been wiped.',
    ], 200)->withCookie($cookie);
})->middleware('auth:sanctum');

// Public routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/find', [ProductController::class, 'getBySpecifications']);
    // Route::get('/categories', [ProductController::class, 'categories']);
    Route::get('/{identifier}', [ProductController::class, 'show']);
});

// Public category routes for API testing
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'publicIndex']);
    Route::get('/{category}', [CategoryController::class, 'publicShow']);
});

// Contact Us
Route::get('/contact-us', [ContactUsController::class, 'index']);

// Cart routes - support both guest and authenticated users
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/add', [CartController::class, 'add']);
    Route::put('/{productId}', [CartController::class, 'update']);
    Route::delete('/{productId}', [CartController::class, 'remove']);
    Route::delete('/', [CartController::class, 'clear']);
    Route::get('/summary', [CartController::class, 'summary']);
    Route::get('/count', [CartController::class, 'count']);
});

// Checkout routes - public for guest checkout, but can be used by authenticated users too
Route::prefix('checkout')->group(function () {
    Route::post('/initiate', [CheckoutController::class, 'initiate']);
    Route::get('/complete', [CheckoutController::class, 'completeGet'])->name('checkout.complete');
    Route::post('/complete', [CheckoutController::class, 'completePost'])->name('checkout.complete.post');

    Route::get('/fail', [CheckoutController::class, 'failGet'])->name('checkout.fail');
    Route::post('/fail', [CheckoutController::class, 'failPost'])->name('checkout.fail.post');
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

    // Wishlist routes
    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index']);
        Route::post('/', [WishlistController::class, 'store']);
        Route::delete('/{productId}', [WishlistController::class, 'destroy']);
        Route::get('/check/{productId}', [WishlistController::class, 'check']);
        Route::delete('/', [WishlistController::class, 'clear']);
    });

    // Customer address routes
    Route::prefix('addresses')->group(function () {
        Route::get('/', [CustomerAddressController::class, 'index']);
        Route::post('/', [CustomerAddressController::class, 'store']);
        Route::get('/{address}', [CustomerAddressController::class, 'show']);
        Route::put('/{address}', [CustomerAddressController::class, 'update']);
        Route::delete('/{address}', [CustomerAddressController::class, 'destroy']);
        Route::patch('/{address}/default', [CustomerAddressController::class, 'setDefault']);
    });
});

// Admin routes - use session auth instead of Sanctum, require admin
Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard/stats', [\App\Http\Controllers\DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('/dashboard/products', [\App\Http\Controllers\DashboardController::class, 'recentProducts'])->name('dashboard.products');
    Route::get('/dashboard/categories', [\App\Http\Controllers\DashboardController::class, 'categories'])->name('dashboard.categories');
    Route::get('/dashboard/revenue', [\App\Http\Controllers\DashboardController::class, 'revenueChart'])->name('dashboard.revenue');
    Route::get('/dashboard/best-sellers', [\App\Http\Controllers\DashboardController::class, 'bestSellers'])->name('dashboard.best-sellers');

    // Product management
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'indexAdmin']);
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

// Supplier routes - separate from admin
Route::middleware(['web', 'auth', 'supplier'])->prefix('supplier')->group(function () {
    // Dashboard
    Route::get('/dashboard/stats', [\App\Http\Controllers\SupplierDashboardController::class, 'stats'])->name('supplier.dashboard.stats');

    // Orders - view and update status
    Route::get('/orders', [\App\Http\Controllers\SupplierDashboardController::class, 'orders'])->name('supplier.orders.index');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\SupplierDashboardController::class, 'updateStatus'])->name('supplier.orders.update-status');
});

// Team member API routes - public for now to return JSON
Route::prefix('admin/team-members')->group(function () {
    Route::get('/', [TeamMemberApiController::class, 'index']);
    Route::get('/{teamMember}', [TeamMemberApiController::class, 'show']);
});

// Contact Inquiries API routes

/**
 * @group Contact Inquiries
 *
 * Public endpoints for viewing published contact inquiries (testimonials)
 *
 * @unauthenticated
 */

/**
 * List published inquiries
 *
 * Get a paginated list of published contact inquiries.
 * Only inquiries that have been replied to and marked as published are returned.
 * Sensitive fields like email and phone are excluded from the response.
 *
 * @queryParam per_page integer Items per page. Default: 10. Example: 15
 *
 * @response 200 scenario="Success" {
 *   "data": [
 *     {
 *       "full_name": "John Doe",
 *       "company": "Acme Inc",
 *       "message": "Great service! Very satisfied with the quality.",
 *       "reply_message": "Thank you for your feedback! We're glad you're happy.",
 *       "created_at": "2024-01-15T10:00:00.000000Z"
 *     }
 *   ],
 *   "meta": {
 *     "current_page": 1,
 *     "last_page": 5,
 *     "per_page": 10,
 *     "total": 50
 *   }
 * }
 */
Route::get('contact-inquiries/published', [ContactInquiryController::class, 'published'])->name('api.contact-inquiries.published');

/**
 * @group Contact Inquiries
 *
 * Admin endpoints for managing all contact inquiries
 *
 * @authenticated
 */

/**
 * List all inquiries
 *
 * Get a paginated list of all contact inquiries (including unpublished).
 * Supports filtering by status.
 *
 * @authenticated
 *
 * @queryParam per_page integer Items per page. Default: 15. Example: 10
 * @queryParam status string Filter by status (pending, replied, closed). Example: pending
 *
 * @response 200 scenario="Success" {
 *   "data": [
 *     {
 *       "id": 1,
 *       "full_name": "John Doe",
 *       "email": "john@example.com",
 *       "phone": "+1234567890",
 *       "company": "Acme Inc",
 *       "message": "Interested in your products",
 *       "status": "pending",
 *       "status_label": "Pending",
 *       "status_color": "yellow",
 *       "replied_at": null,
 *       "reply_message": null,
 *       "created_at": "2024-01-15T10:00:00.000000Z",
 *       "updated_at": "2024-01-15T10:00:00.000000Z"
 *     }
 *   ]
 * }
 * @response 401 scenario="Unauthenticated" {
 *   "message": "Unauthenticated."
 * }
 */
Route::get('admin/inquiries', [ContactInquiryController::class, 'adminIndex'])->name('api.admin.inquiries.index')->middleware(['auth:sanctum', 'admin']);

/**
 * Publish an inquiry
 *
 * Mark a contact inquiry as published.
 * Only inquiries that have been replied to can be published.
 *
 * @authenticated
 *
 * @urlParam inquiry integer required The inquiry ID. Example: 1
 *
 * @response 200 scenario="Success" {
 *   "message": "Inquiry published successfully.",
 *   "data": {
 *     "id": 1,
 *     "full_name": "John Doe",
 *     "email": "john@example.com",
 *     "phone": "+1234567890",
 *     "company": "Acme Inc",
 *     "message": "Great service!",
 *     "status": "replied",
 *     "status_label": "Replied",
 *     "status_color": "green",
 *     "replied_at": "2024-01-15T10:30:00.000000Z",
 *     "reply_message": "Thank you for your feedback!",
 *     "created_at": "2024-01-15T10:00:00.000000Z",
 *     "updated_at": "2024-01-15T10:30:00.000000Z"
 *   }
 * }
 * @response 403 scenario="Not Replied" {
 *   "message": "Only replied inquiries can be published."
 * }
 * @response 404 scenario="Not Found" {
 *   "message": "Resource not found."
 * }
 * @response 401 scenario="Unauthenticated" {
 *   "message": "Unauthenticated."
 * }
 */
Route::post('admin/inquiries/{inquiry}/publish', [ContactInquiryController::class, 'publish'])->name('api.admin.inquiries.publish')->middleware(['auth:sanctum', 'admin']);

/**
 * Unpublish an inquiry
 *
 * Mark a published contact inquiry as unpublished.
 *
 * @authenticated
 *
 * @urlParam inquiry integer required The inquiry ID. Example: 1
 *
 * @response 200 scenario="Success" {
 *   "message": "Inquiry unpublished successfully.",
 *   "data": {
 *     "id": 1,
 *     "full_name": "John Doe",
 *     "email": "john@example.com",
 *     "phone": "+1234567890",
 *     "company": "Acme Inc",
 *     "message": "Great service!",
 *     "status": "replied",
 *     "status_label": "Replied",
 *     "status_color": "green",
 *     "replied_at": "2024-01-15T10:30:00.000000Z",
 *     "reply_message": "Thank you for your feedback!",
 *     "created_at": "2024-01-15T10:00:00.000000Z",
 *     "updated_at": "2024-01-15T10:35:00.000000Z"
 *   }
 * }
 * @response 404 scenario="Not Found" {
 *   "message": "Resource not found."
 * }
 * @response 401 scenario="Unauthenticated" {
 *   "message": "Unauthenticated."
 * }
 */
Route::post('admin/inquiries/{inquiry}/unpublish', [ContactInquiryController::class, 'unpublish'])->name('api.admin.inquiries.unpublish')->middleware(['auth:sanctum', 'admin']);

/**
 * @group Contact Inquiries
 *
 * General inquiry management
 *
 * @authenticated
 */
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
