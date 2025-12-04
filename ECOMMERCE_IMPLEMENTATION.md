# E-Commerce API - Complete Implementation Guide

## Project Structure Overview

This is a complete Laravel e-commerce API implementation with support for:
- Product management and cataloging
- Shopping cart management
- Order creation and processing
- Order status tracking
- Stock inventory management
- User order history

---

## Database Setup Commands

### 1. Create Fresh Database with All Migrations
```bash
php artisan migrate:fresh
```
This command will:
- Drop all existing tables
- Run all migrations in order
- Create all necessary tables

### 2. Seed the Database with Sample Data
```bash
php artisan db:seed
```
This command will:
- Create 5 product categories
- Create 7 sample products with different categories
- Create a test user (email: test@example.com)

### 3. Run Both Together (Recommended for Fresh Setup)
```bash
php artisan migrate:fresh --seed
```

---

## Key Files Created & Modified

### Models (With Relationships)

#### 1. **User.php**
- `orders()` - Get all orders for this user
- New fillable fields: phone, address, city, zip_code, country

#### 2. **Product.php**
- `category()` - Belongs to Category
- `orderItems()` - Has many OrderItems
- `hasStock(quantity)` - Check if product has enough stock
- `reduceStock(quantity)` - Reduce inventory
- `increaseStock(quantity)` - Restore inventory
- Fillable: name, description, price, cost, stock, sku, category_id, is_active

#### 3. **Order.php**
- `user()` - Belongs to User
- `items()` - Has many OrderItems
- Constants for statuses: PENDING, PROCESSING, SHIPPED, DELIVERED, CANCELLED
- Constants for payment: PENDING, PAID, FAILED, REFUNDED
- `generateOrderNumber()` - Create unique order ID
- `calculateTotal()` - Calculate subtotal + tax + shipping
- `canBeCancelled()` - Check if order can be cancelled
- `cancel()` - Cancel and restore stock

#### 4. **OrderItem.php**
- `order()` - Belongs to Order
- `product()` - Belongs to Product
- `calculateSubtotal()` - Compute item total

#### 5. **Category.php**
- `products()` - Has many Products

---

## Controllers

### 1. **ProductController** (`app/Http/Controllers/ProductController.php`)

**Public Endpoints:**
- `GET /api/products` - List all products with filtering
  - Query params: category_id, search, sort_by, sort_direction, per_page
- `GET /api/products/{id}` - Get product details
- `GET /api/products/categories` - Get all categories

**Admin Endpoints:**
- `POST /api/admin/products` - Create new product
- `PUT /api/admin/products/{id}` - Update product
- `DELETE /api/admin/products/{id}` - Delete product
- `GET /api/admin/products/low-stock` - Get low stock items

### 2. **OrderController** (`app/Http/Controllers/OrderController.php`)

**User Endpoints:**
- `GET /api/orders` - List user's orders with filtering
  - Query params: status, payment_status, per_page
- `GET /api/orders/{id}` - Get order details
- `POST /api/orders` - Create new order
- `POST /api/orders/{id}/cancel` - Cancel order

**Admin Endpoints:**
- `PATCH /api/orders/{id}/status` - Update order status & payment
- `GET /api/admin/orders/statistics` - Get order statistics

### 3. **CartController** (`app/Http/Controllers/CartController.php`)

- `GET /api/cart` - Get cart contents
- `POST /api/cart/add` - Add item to cart
- `PATCH /api/cart/{productId}` - Update item quantity
- `DELETE /api/cart/{productId}` - Remove item
- `DELETE /api/cart` - Clear entire cart
- `GET /api/cart/summary` - Get cart totals (subtotal, tax, shipping)

---

## Services

### 1. **OrderService** (`app/Services/OrderService.php`)
- `createOrder(data, userId)` - Create order with stock validation
- `cancelOrder(order)` - Cancel and refund
- `refundOrder(order)` - Process refund
- `updateOrderStatus(order, status)` - Change status
- `getStatistics()` - Get order metrics

### 2. **CartService** (`app/Services/CartService.php`)
- `addItem(cart, productId, quantity)` - Add to cart
- `updateItem(cart, productId, quantity)` - Update quantity
- `removeItem(cart, productId)` - Remove from cart
- `getSummary(cart)` - Get totals
- `getFormattedItems(cart)` - Format for API response

---

## Request Validation

### **StoreOrderRequest** (`app/Http/Requests/StoreOrderRequest.php`)
Validates order creation:
- items (array, required, min 1 item)
- items[].product_id (required, must exist)
- items[].quantity (required, integer, min 1, max 100)
- shipping_address (required with: street, city, zip_code, country)
- notes (optional, max 500 chars)

---

## API Resources (JSON Response Formatting)

- **OrderResource** - Format order with items and user info
- **OrderItemResource** - Format individual order items
- **ProductResource** - Format product with category
- **CategoryResource** - Format category data

---

## Seeders

### **CategorySeeder** - Creates 5 categories:
1. Electronics
2. Clothing
3. Books
4. Home & Garden
5. Sports

### **ProductSeeder** - Creates 7 sample products:
1. Wireless Headphones ($129.99)
2. Smartwatch ($199.99)
3. Cotton T-Shirt ($29.99)
4. Denim Jeans ($59.99)
5. Programming Book ($39.99)
6. Yoga Mat ($49.99)
7. Plant Pot ($24.99)

---

## Events & Listeners

Events created for order lifecycle:
- **OrderCreated** - Fired when order is created
- **OrderShipped** - Fired when order status changes to shipped
- **OrderCancelled** - Fired when order is cancelled

---

## Policy

### **OrderPolicy** (`app/Policies/OrderPolicy.php`)
- `view()` - User can view their own orders or admin can view all
- `update()` - User can update their orders or admin can update all
- `delete()` - Only admins can delete orders

---

## API Route Structure

```
Public Routes:
├── GET    /api/products                      (List products)
├── GET    /api/products/{id}                (View product)
└── GET    /api/products/categories          (List categories)

Authenticated Routes:
├── Cart Routes
│   ├── GET    /api/cart                     (View cart)
│   ├── POST   /api/cart/add                 (Add to cart)
│   ├── PATCH  /api/cart/{productId}         (Update quantity)
│   ├── DELETE /api/cart/{productId}         (Remove item)
│   ├── DELETE /api/cart                     (Clear cart)
│   └── GET    /api/cart/summary             (Get totals)
│
└── Order Routes
    ├── GET    /api/orders                   (List user orders)
    ├── POST   /api/orders                   (Create order)
    ├── GET    /api/orders/{id}              (View order)
    ├── PATCH  /api/orders/{id}/status       (Update status - Admin)
    └── POST   /api/orders/{id}/cancel       (Cancel order)

Admin Routes:
├── Product Management
│   ├── POST   /api/admin/products           (Create product)
│   ├── PUT    /api/admin/products/{id}      (Update product)
│   ├── DELETE /api/admin/products/{id}      (Delete product)
│   └── GET    /api/admin/products/low-stock (Low stock items)
│
└── Order Management
    └── GET    /api/admin/orders/statistics  (Order stats)
```

---

## Order Processing Flow

### Complete Order Cycle:

```
1. Customer Browses Products
   └─> GET /api/products

2. Add to Cart
   └─> POST /api/cart/add
   └─> Gets stored in session

3. Review Cart
   └─> GET /api/cart
   └─> GET /api/cart/summary

4. Checkout (Create Order)
   └─> POST /api/orders
   └─> Validates stock
   └─> Creates order with items
   └─> Reduces product stock
   └─> Calculates totals (subtotal + tax + shipping)
   └─> Returns order details

5. Order Processing (Admin)
   └─> View orders: GET /api/orders
   └─> Update status: PATCH /api/orders/{id}/status
   └─> Statuses: pending → processing → shipped → delivered

6. Order Cancellation
   └─> POST /api/orders/{id}/cancel
   └─> Restores product stock
   └─> Updates status to cancelled
   └─> Refunds payment (if applicable)
```

---

## Complete Setup Instructions

### Step 1: Database Setup
```bash
php artisan migrate:fresh --seed
```

### Step 2: Run Development Server
```bash
php artisan serve
```

### Step 3: Test API Endpoints
Use Postman or similar tool with base URL: `http://localhost:8000/api`

---

## Example API Requests

### Get All Products
```
GET /api/products?per_page=10&category_id=1&sort_by=price&sort_direction=asc
```

### Create Order
```
POST /api/orders
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

### Get User Orders
```
GET /api/orders?status=pending
```

### Update Order Status (Admin)
```
PATCH /api/orders/{id}/status
Content-Type: application/json

{
  "status": "shipped",
  "payment_status": "paid"
}
```

### Cart Operations
```
// Add to cart
POST /api/cart/add
{
  "product_id": 1,
  "quantity": 2
}

// Get cart summary
GET /api/cart/summary
// Returns: subtotal, tax, shipping, total, item_count
```

---

## Pricing & Calculations

- **Tax**: 10% of subtotal
- **Shipping**:
  - Free for orders over $100
  - $10 for orders under $100
- **Stock Management**: Automatically reduced on order creation, restored on cancellation

---

## Key Features Implemented

✅ Product catalog with categories
✅ Shopping cart management (session-based)
✅ Order creation with stock validation
✅ Order status tracking (pending → processing → shipped → delivered)
✅ Payment status tracking (pending → paid → refunded)
✅ Stock inventory management
✅ Order cancellation with refunds
✅ Tax & shipping calculations
✅ Order statistics for admins
✅ User order history
✅ API request validation
✅ Authorization policies
✅ Database seeders for testing

---

## Notes

- Cart is stored in session (suitable for development; use database for production)
- Implement payment gateway integration (Stripe, PayPal) for actual payments
- Events can be connected to listeners for email notifications
- Use queue jobs for long-running tasks like order processing
- Implement caching for frequently accessed products
- Add rate limiting for production security
