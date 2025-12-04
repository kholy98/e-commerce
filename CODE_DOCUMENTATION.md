# Complete Code Documentation with Explanations

## Table of Contents
1. [Models](#models)
2. [Controllers](#controllers)
3. [Services](#services)
4. [Routes](#routes)
5. [Database Seeders](#database-seeders)
6. [API Examples](#api-examples)

---

## Models

### User Model (Updated)
```php
<?php
namespace App\Models;

// Relationship: One-to-Many with Orders
public function orders()
{
    return $this->hasMany(Order::class);
}
```
**What it does**: Allows accessing all orders for a user via `$user->orders`

**Usage**:
```php
$user = User::find(1);
$orders = $user->orders()->where('status', 'pending')->get();
```

---

### Product Model (Complete)
```php
<?php
namespace App\Models;

// Fillable attributes
protected $fillable = [
    'name', 'description', 'price', 'cost', 'stock', 'sku', 'category_id', 'is_active'
];

// Type casting for database values
protected $casts = [
    'price' => 'decimal:2',
    'cost' => 'decimal:2',
    'stock' => 'integer',
    'is_active' => 'boolean',
];

// Relationship to Category (Many-to-One)
public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);
}

// Check if product has enough stock
public function hasStock(int $quantity): bool
{
    return $this->stock >= $quantity;
}

// Reduce product stock on order
public function reduceStock(int $quantity): void
{
    $this->decrement('stock', $quantity);
}

// Restore stock on order cancellation
public function increaseStock(int $quantity): void
{
    $this->increment('stock', $quantity);
}
```

**Example Usage**:
```php
$product = Product::find(1);

// Check stock
if ($product->hasStock(5)) {
    $product->reduceStock(5); // Reduce stock by 5
}

// Get category
$category = $product->category; // Electronics

// Restore stock
$product->increaseStock(5);
```

---

### Order Model (Complete)
```php
<?php
namespace App\Models;

// Order status constants
const STATUS_PENDING = 'pending';
const STATUS_PROCESSING = 'processing';
const STATUS_SHIPPED = 'shipped';
const STATUS_DELIVERED = 'delivered';
const STATUS_CANCELLED = 'cancelled';

// Payment status constants
const PAYMENT_STATUS_PENDING = 'pending';
const PAYMENT_STATUS_PAID = 'paid';
const PAYMENT_STATUS_FAILED = 'failed';
const PAYMENT_STATUS_REFUNDED = 'refunded';

// Generate unique order number: ORD-20231215143022-ABC123
public static function generateOrderNumber(): string
{
    return 'ORD-' . date('YmdHis') . '-' . strtoupper(bin2hex(random_bytes(3)));
}

// Calculate total with tax and shipping
public function calculateTotal(): void
{
    $this->subtotal = $this->items->sum('subtotal');
    $this->tax = round($this->subtotal * 0.1, 2); // 10% tax
    $this->shipping_cost = $this->subtotal > 100 ? 0 : 10; // Free shipping over $100
    $this->total_amount = $this->subtotal + $this->tax + $this->shipping_cost;
    $this->save();
}

// Cancel order if in correct status
public function cancel(): void
{
    if (!$this->canBeCancelled()) {
        throw new \Exception('Order cannot be cancelled');
    }
    
    // Restore stock for each item
    foreach ($this->items as $item) {
        $item->product->increaseStock($item->quantity);
    }
    
    $this->status = self::STATUS_CANCELLED;
    $this->save();
}
```

**Example Usage**:
```php
// Create order
$order = Order::create([
    'order_number' => Order::generateOrderNumber(),
    'user_id' => 1,
    'status' => Order::STATUS_PENDING,
    'payment_status' => Order::PAYMENT_STATUS_PENDING,
    'total_amount' => 250.00
]);

// Calculate totals
$order->calculateTotal();

// Check if can be cancelled
if ($order->canBeCancelled()) {
    $order->cancel();
}

// Get user who placed order
$user = $order->user;

// Get all items in order
$items = $order->items;
```

---

### OrderItem Model (Complete)
```php
<?php
namespace App\Models;

protected $fillable = [
    'order_id', 'product_id', 'quantity', 'unit_price', 'subtotal'
];

// Relationships
public function order(): BelongsTo
{
    return $this->belongsTo(Order::class);
}

public function product(): BelongsTo
{
    return $this->belongsTo(Product::class);
}

// Calculate item subtotal
public function calculateSubtotal(): void
{
    $this->subtotal = round($this->unit_price * $this->quantity, 2);
    $this->save();
}
```

**Example Usage**:
```php
// Create order item
$item = OrderItem::create([
    'order_id' => 1,
    'product_id' => 5,
    'quantity' => 3,
    'unit_price' => 99.99,
]);

$item->calculateSubtotal(); // Sets subtotal to 299.97

// Access relationships
$order = $item->order;
$product = $item->product;
```

---

## Controllers

### ProductController - Key Methods Explained

#### 1. **index()** - List Products with Filtering
```php
public function index(Request $request): JsonResponse
{
    $query = Product::query()->where('is_active', true);

    // Filter by category
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Search functionality
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // Sorting
    if ($request->has('sort_by')) {
        $sort = $request->sort_by;
        $direction = $request->get('sort_direction', 'asc');
        if (in_array($sort, ['price', 'name', 'created_at'])) {
            $query->orderBy($sort, $direction);
        }
    }

    $products = $query->paginate($request->get('per_page', 15));
    
    return response()->json(['success' => true, 'data' => $products]);
}
```

**API Usage**:
```
GET /api/products?category_id=1&search=shirt&sort_by=price&sort_direction=asc&per_page=10
```

---

### OrderController - Create Order (Complex Logic)

```php
public function store(Request $request): JsonResponse
{
    $validated = $request->validate([
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'shipping_address' => 'required|array',
        'notes' => 'nullable|string',
    ]);

    try {
        // Start transaction - ensures data consistency
        DB::beginTransaction();

        // 1. Create order header
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => auth()->id(),
            'status' => Order::STATUS_PENDING,
            'payment_status' => Order::PAYMENT_STATUS_PENDING,
            'shipping_address' => $validated['shipping_address'],
        ]);

        // 2. Add items and check stock
        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            // Check if product has enough stock
            if (!$product->hasStock($item['quantity'])) {
                DB::rollBack(); // Undo all changes
                return response()->json([
                    'success' => false,
                    'message' => "Product {$product->name} has insufficient stock",
                ], 422);
            }

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'subtotal' => round($product->price * $item['quantity'], 2),
            ]);

            // Reduce stock immediately
            $product->reduceStock($item['quantity']);
        }

        // 3. Calculate totals (tax, shipping)
        $order->calculateTotal();

        DB::commit(); // Save all changes

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order->load('items'),
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack(); // Undo everything if error
        return response()->json([
            'success' => false,
            'message' => 'Failed to create order: ' . $e->getMessage(),
        ], 500);
    }
}
```

**Why DB::beginTransaction()?**: Ensures if any step fails, all changes are rolled back. This prevents partial orders or stock reduction without order creation.

---

### CartController - Add to Cart

```php
public function add(Request $request): JsonResponse
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::find($validated['product_id']);

    // Check if product is available
    if (!$product->is_active) {
        return response()->json([
            'success' => false,
            'message' => 'Product is not available',
        ], 422);
    }

    // Check stock
    if (!$product->hasStock($validated['quantity'])) {
        return response()->json([
            'success' => false,
            'message' => 'Insufficient stock',
        ], 422);
    }

    // Get current cart from session
    $cart = $request->session()->get('cart', []);

    // Add or update item
    if (isset($cart[$validated['product_id']])) {
        $newQuantity = $cart[$validated['product_id']] + $validated['quantity'];
        if (!$product->hasStock($newQuantity)) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot add more, insufficient stock',
            ], 422);
        }
        $cart[$validated['product_id']] = $newQuantity;
    } else {
        $cart[$validated['product_id']] = $validated['quantity'];
    }

    // Save cart back to session
    $request->session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'message' => 'Item added to cart',
    ]);
}
```

**Cart Session Format**:
```php
[
    1 => 2,  // Product ID 1, quantity 2
    3 => 1,  // Product ID 3, quantity 1
    5 => 3,  // Product ID 5, quantity 3
]
```

---

## Services

### OrderService - Business Logic

```php
<?php
namespace App\Services;

class OrderService
{
    /**
     * Create order with transactions for data safety
     */
    public function createOrder(array $data, int $userId): Order
    {
        return DB::transaction(function () use ($data, $userId) {
            // Creates order with all validations
            // Returns Order or throws exception
        });
    }

    /**
     * Cancel order and restore stock
     */
    public function cancelOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            // Check if can be cancelled
            if (!$order->canBeCancelled()) {
                throw new \Exception('Order cannot be cancelled at this status');
            }

            // Restore stock for each product
            foreach ($order->items as $item) {
                $item->product->increaseStock($item->quantity);
            }

            // Update order status
            $order->update([
                'status' => Order::STATUS_CANCELLED,
                'payment_status' => Order::PAYMENT_STATUS_REFUNDED,
            ]);
        });
    }

    /**
     * Get statistics for dashboard
     */
    public function getStatistics(): array
    {
        return [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            // ... more stats
        ];
    }
}
```

**Usage in Controller**:
```php
$service = new OrderService();
$order = $service->createOrder($data, auth()->id());
```

---

## Routes

### api.php - Complete Route Structure

```php
<?php
// Public routes - no authentication needed
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/categories', [ProductController::class, 'categories']);
    Route::get('/{product}', [ProductController::class, 'show']);
});

// Protected routes - requires authentication
Route::middleware('auth:sanctum')->group(function () {
    
    // Shopping cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'add']);
        Route::patch('/{productId}', [CartController::class, 'update']);
        Route::delete('/{productId}', [CartController::class, 'remove']);
        Route::get('/summary', [CartController::class, 'summary']);
    });

    // User orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::post('/{order}/cancel', [OrderController::class, 'cancel']);
    });

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus']);
            Route::get('/orders/statistics', [OrderController::class, 'statistics']);
            Route::post('/products', [ProductController::class, 'store']);
        });
    });
});
```

---

## Database Seeders

### CategorySeeder - Populate Categories

```php
<?php
namespace Database\Seeders;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic gadgets', 'is_active' => true],
            ['name' => 'Clothing', 'description' => 'Apparel and fashion', 'is_active' => true],
            // ... more categories
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
```

**Run with**:
```bash
php artisan db:seed --class=CategorySeeder
```

---

### ProductSeeder - Populate Products

```php
<?php
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Headphones',
                'description' => 'High-quality wireless headphones',
                'price' => 129.99,
                'cost' => 50.00,
                'stock' => 50,
                'sku' => 'WH-001',
                'category_id' => Category::where('name', 'Electronics')->first()->id,
                'is_active' => true,
            ],
            // ... more products
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
```

---

## API Examples

### 1. Create Order - Step by Step

**Request**:
```bash
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
  "items": [
    {
      "product_id": 1,
      "quantity": 2
    },
    {
      "product_id": 3,
      "quantity": 1
    }
  ],
  "shipping_address": {
    "street": "123 Main St",
    "city": "New York",
    "zip_code": "10001",
    "country": "USA"
  },
  "notes": "Please deliver in the morning"
}
```

**Response** (Success):
```json
{
  "success": true,
  "message": "Order created successfully",
  "data": {
    "id": 1,
    "order_number": "ORD-20231215143022-ABC123",
    "user_id": 1,
    "status": "pending",
    "payment_status": "pending",
    "subtotal": 289.97,
    "tax": 28.997,
    "shipping_cost": 0,
    "total_amount": 318.967,
    "items": [
      {
        "product_id": 1,
        "quantity": 2,
        "unit_price": 129.99,
        "subtotal": 259.98
      },
      {
        "product_id": 3,
        "quantity": 1,
        "unit_price": 29.99,
        "subtotal": 29.99
      }
    ]
  }
}
```

---

### 2. Get User Orders

**Request**:
```bash
GET /api/orders?status=pending
Authorization: Bearer {token}
```

**Response**:
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "order_number": "ORD-20231215143022-ABC123",
        "status": "pending",
        "payment_status": "pending",
        "total_amount": 318.967,
        "created_at": "2024-12-15T14:30:22Z"
      }
    ],
    "links": { "first": "...", "last": "...", "prev": null, "next": null },
    "meta": { "current_page": 1, "per_page": 15, "total": 1 }
  }
}
```

---

### 3. Cancel Order

**Request**:
```bash
POST /api/orders/1/cancel
Authorization: Bearer {token}
```

**Response**:
```json
{
  "success": true,
  "message": "Order cancelled successfully",
  "data": {
    "id": 1,
    "status": "cancelled",
    "payment_status": "refunded"
  }
}
```

**What happens behind the scenes**:
1. Validates order can be cancelled (status is pending or processing)
2. Restores all product stock
3. Updates order status to "cancelled"
4. Updates payment status to "refunded"
5. Transaction ensures all or nothing

---

### 4. Get Order Statistics (Admin)

**Request**:
```bash
GET /api/admin/orders/statistics
Authorization: Bearer {admin_token}
```

**Response**:
```json
{
  "success": true,
  "data": {
    "total_orders": 150,
    "pending_orders": 25,
    "processing_orders": 10,
    "shipped_orders": 85,
    "delivered_orders": 28,
    "cancelled_orders": 2,
    "total_revenue": 45230.50,
    "pending_revenue": 7825.00,
    "average_order_value": 301.54
  }
}
```

---

### 5. Update Order Status (Admin)

**Request**:
```bash
PATCH /api/admin/orders/1/status
Authorization: Bearer {admin_token}
Content-Type: application/json

{
  "status": "shipped",
  "payment_status": "paid"
}
```

**Response**:
```json
{
  "success": true,
  "message": "Order status updated successfully",
  "data": {
    "id": 1,
    "status": "shipped",
    "payment_status": "paid"
  }
}
```

---

## Key Design Decisions Explained

### 1. **Transaction Usage in Order Creation**
- Ensures data consistency
- If any step fails, everything rolls back
- Prevents partial orders or orphaned items

### 2. **Stock Validation Before Order**
- Checks stock exists before creating order
- Reduces stock immediately upon order creation
- Restores stock on cancellation

### 3. **Constants for Order Status**
```php
const STATUS_PENDING = 'pending';
const STATUS_SHIPPED = 'shipped';
```
- Type-safe - prevents typos in status comparisons
- Centralizes valid status values
- Easy to reference in code

### 4. **Session-Based Cart**
- Simple implementation for development
- No database queries for cart operations
- Easy to clear or modify
- Note: Consider database persistence for production

### 5. **Service Layer**
- Separates business logic from controllers
- Reusable across multiple controllers
- Easier to test
- Cleaner controller code

---

## Common Scenarios

### Scenario 1: Customer Places Order
```
1. User browses products (GET /api/products)
2. Adds items to cart (POST /api/cart/add)
3. Reviews cart (GET /api/cart/summary)
4. Places order (POST /api/orders)
   - Stock checked and reduced
   - Order created with unique number
   - Tax and shipping calculated
   - Order status: pending
   - Payment status: pending
```

### Scenario 2: Admin Processes Order
```
1. View order (GET /api/orders/1)
2. Update status to processing (PATCH /api/orders/1/status)
3. Process payment
4. Update status to shipped (PATCH /api/orders/1/status)
5. Customer notified (via event listener)
6. Update status to delivered
```

### Scenario 3: Customer Cancels Order
```
1. Request cancellation (POST /api/orders/1/cancel)
2. System checks if possible (pending or processing status)
3. Restores all product stock
4. Updates order status to cancelled
5. Marks payment as refunded
6. Customer notified (via event listener)
```

---

## Performance Optimizations

```php
// Good - Uses eager loading to avoid N+1 queries
$orders = Order::with('items.product', 'user')->get();

// Bad - Will run extra queries
$orders = Order::all();
foreach ($orders as $order) {
    $items = $order->items; // Extra query for each order!
}

// Good - Lock product row during update for consistency
$product = Product::lockForUpdate()->find($id);

// Good - Use pagination for large datasets
$products = Product::paginate(15);

// Bad - Loading all records
$products = Product::all();
```

---

This documentation covers the complete implementation. Refer back to `ECOMMERCE_IMPLEMENTATION.md` for full API reference.
