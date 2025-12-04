# Database Architecture & Migration Reference

## 📊 Database Diagram

```
┌──────────────────┐
│     USERS        │
├──────────────────┤
│ id               │─┐
│ name             │ │
│ email            │ │
│ password         │ │
│ phone            │ │
│ address          │ │ 1──────Many
│ city             │ │
│ zip_code         │ │
│ country          │ │
│ created_at       │ │
│ updated_at       │ │
└──────────────────┘ │
                     │
                     ├──────────────┐
                     │              │
        ┌────────────┴────┐  ┌──────┴──────────────┐
        │                 │  │                     │
   ┌────▼────────────┐ ┌──┴──┴────────────┐  ┌────▼────────────┐
   │    ORDERS       │ │   ORDER_ITEMS    │  │    CATEGORIES   │
   ├─────────────────┤ ├──────────────────┤  ├─────────────────┤
   │ id              │ │ id               │  │ id              │
   │ order_number    │ │ order_id      ───┼──┤ name            │
   │ user_id      ───┼─│ product_id    ───┼──┤ description     │
   │ status          │ │ quantity         │  │ is_active       │
   │ payment_status  │ │ unit_price       │  │ created_at      │
   │ subtotal        │ │ subtotal         │  │ updated_at      │
   │ tax             │ │ created_at       │  └─────────────────┘
   │ shipping_cost   │ │ updated_at       │         ▲
   │ total_amount    │ │                  │         │
   │ shipping_addr   │ │                  │         │ Many
   │ notes           │ └──────────────────┘         │
   │ created_at      │         │                    │
   │ updated_at      │         │                    │
   └─────────────────┘         │          ┌─────────┴──────────┐
                               │          │                    │
                               └──────────┼────────────────┐   │
                                          │                │   │
                               ┌──────────▼──────────────┐ │ 1─┤
                               │      PRODUCTS          │ │   │
                               ├───────────────────────┤ │   │
                               │ id                    │ │   │
                               │ name                  │ │   │
                               │ description           │ │   │
                               │ price                 │ │   │
                               │ cost                  │ │   │
                               │ stock                 │ │   │
                               │ sku                   │ │   │
                               │ category_id        ───┼─┘   │
                               │ is_active             │      │
                               │ created_at            │      │
                               │ updated_at            │      │
                               └───────────────────────┘      │
                                                               │
                                              Many─────────1──┤
```

## 🗄️ Table Structure Details

### USERS Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255),
    city VARCHAR(100),
    zip_code VARCHAR(20),
    country VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### CATEGORIES Table
```sql
CREATE TABLE categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### PRODUCTS Table
```sql
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    cost DECIMAL(10,2),
    stock INT DEFAULT 0,
    sku VARCHAR(255) UNIQUE NOT NULL,
    category_id BIGINT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE INDEX idx_category_id ON products(category_id);
CREATE INDEX idx_sku ON products(sku);
```

### ORDERS Table
```sql
CREATE TABLE orders (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    user_id BIGINT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    -- pending, processing, shipped, delivered, cancelled
    payment_status VARCHAR(50) DEFAULT 'pending',
    -- pending, paid, failed, refunded
    subtotal DECIMAL(10,2),
    tax DECIMAL(10,2),
    shipping_cost DECIMAL(10,2),
    total_amount DECIMAL(10,2) NOT NULL,
    shipping_address JSON,
    notes TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX idx_user_id ON orders(user_id);
CREATE INDEX idx_status ON orders(status);
CREATE INDEX idx_payment_status ON orders(payment_status);
CREATE INDEX idx_order_number ON orders(order_number);
```

### ORDER_ITEMS Table
```sql
CREATE TABLE order_items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    order_id BIGINT NOT NULL,
    product_id BIGINT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
);

CREATE INDEX idx_order_id ON order_items(order_id);
CREATE INDEX idx_product_id ON order_items(product_id);
```

---

## 🔄 Data Relationships

### One-to-Many: User → Orders
```php
$user->orders()  // Get all orders for a user
$order->user()   // Get user who placed the order
```

### One-to-Many: Order → OrderItems
```php
$order->items()  // Get all items in an order
$item->order()   // Get the order this item belongs to
```

### One-to-Many: Product → OrderItems
```php
$product->orderItems()  // Get all times this product was ordered
$item->product()        // Get the product for this order item
```

### One-to-Many: Category → Products
```php
$category->products()   // Get all products in category
$product->category()    // Get the category for a product
```

---

## 📈 Database Queries Reference

### Get User with All Orders
```php
$user = User::with('orders')->find(1);

// Get user's completed orders
$orders = User::find(1)
    ->orders()
    ->where('status', 'delivered')
    ->get();

// Get user's pending orders with items
$orders = User::find(1)
    ->orders()
    ->with('items.product')
    ->where('status', 'pending')
    ->get();
```

### Get Order with Full Details
```php
$order = Order::with('items.product', 'user', 'items.product.category')
    ->find(1);
```

### Get Products in Category with Stock
```php
$products = Category::find(1)
    ->products()
    ->where('is_active', true)
    ->where('stock', '>', 0)
    ->get();
```

### Get Low Stock Products
```php
$lowStock = Product::where('stock', '<', 10)
    ->where('is_active', true)
    ->orderBy('stock', 'asc')
    ->get();
```

### Get Order Statistics
```php
// Revenue by status
$stats = Order::selectRaw('status, COUNT(*) as count, SUM(total_amount) as revenue')
    ->groupBy('status')
    ->get();

// Revenue by date
$dailyRevenue = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
    ->where('payment_status', 'paid')
    ->groupBy('date')
    ->get();

// Top products
$topProducts = Product::selectRaw('products.id, products.name, SUM(order_items.quantity) as total_sold')
    ->join('order_items', 'products.id', '=', 'order_items.product_id')
    ->groupBy('products.id', 'products.name')
    ->orderBy('total_sold', 'desc')
    ->limit(10)
    ->get();
```

---

## 🔑 Indexes & Performance

### Indexes Created
```sql
-- Product queries
CREATE INDEX idx_category_id ON products(category_id);
CREATE INDEX idx_sku ON products(sku);
CREATE INDEX idx_is_active ON products(is_active);

-- Order queries
CREATE INDEX idx_user_id ON orders(user_id);
CREATE INDEX idx_status ON orders(status);
CREATE INDEX idx_payment_status ON orders(payment_status);
CREATE INDEX idx_order_number ON orders(order_number);
CREATE INDEX idx_created_at ON orders(created_at);

-- Order items queries
CREATE INDEX idx_order_id ON order_items(order_id);
CREATE INDEX idx_product_id ON order_items(product_id);
```

### Why These Indexes?
- **user_id**: Frequently filter orders by user
- **status**: Dashboard queries for pending/shipped orders
- **payment_status**: Revenue reports
- **created_at**: Time-based queries
- **category_id**: Browse products by category
- **order_id**: Retrieve items for an order

---

## 🔄 Migration Files

### Expected Existing Migrations
Your project should have these (check `database/migrations/`):

1. `0001_01_01_000000_create_users_table.php` - Users table
2. `0001_01_01_000001_create_cache_table.php` - Cache table
3. `0001_01_01_000002_create_jobs_table.php` - Job queue table
4. `2025_12_03_152833_create_personal_access_tokens_table.php` - Sanctum tokens
5. `2025_12_03_153235_create_permission_tables.php` - Permissions
6. `2025_12_03_153418_create_media_table.php` - Media uploads
7. `2025_12_03_153758_create_categories_table.php` - Categories
8. `2025_12_03_153806_create_products_table.php` - Products
9. `2025_12_03_153816_create_order_items_table.php` - Order items
10. `2025_12_03_153821_create_orders_table.php` - Orders

---

## 📋 Migration Checklist

Before running migrations, verify these columns exist:

### Users Table Must Have:
- ✅ id, name, email, password
- ✅ phone, address, city, zip_code, country
- ✅ created_at, updated_at

### Categories Table Must Have:
- ✅ id, name, description
- ✅ is_active (boolean)
- ✅ created_at, updated_at

### Products Table Must Have:
- ✅ id, name, description
- ✅ price (decimal), cost (decimal)
- ✅ stock (integer), sku (unique)
- ✅ category_id (foreign key)
- ✅ is_active (boolean)
- ✅ created_at, updated_at

### Orders Table Must Have:
- ✅ id, order_number (unique)
- ✅ user_id (foreign key)
- ✅ status, payment_status
- ✅ subtotal, tax, shipping_cost, total_amount
- ✅ shipping_address (json), notes (text)
- ✅ created_at, updated_at

### OrderItems Table Must Have:
- ✅ id, order_id (foreign key)
- ✅ product_id (foreign key)
- ✅ quantity (integer)
- ✅ unit_price (decimal), subtotal (decimal)
- ✅ created_at, updated_at

---

## 🚀 Running Migrations

### Fresh Setup (Recommended)
```bash
# Drop all tables and recreate
php artisan migrate:fresh
```

### Update Existing Database
```bash
# Run all pending migrations
php artisan migrate

# Rollback last batch
php artisan migrate:rollback

# Rollback all and re-run
php artisan migrate:reset
php artisan migrate

# Refresh (rollback & migrate)
php artisan migrate:refresh
```

### With Seeders
```bash
# Fresh + seed
php artisan migrate:fresh --seed

# Refresh + seed
php artisan migrate:refresh --seed

# Just seed
php artisan db:seed

# Specific seeder
php artisan db:seed --class=ProductSeeder
```

---

## 🔍 Database Verification

### Check Database Connection
```bash
php artisan tinker

# Inside tinker:
DB::connection()->getPdo()
// Should return: PDOConnection object

DB::select('SELECT DATABASE()')
// Should show your database name
```

### Verify Tables
```bash
php artisan tinker

# Check if tables exist:
App\Models\User::count()
App\Models\Category::count()
App\Models\Product::count()
App\Models\Order::count()
App\Models\OrderItem::count()
```

### Check Columns
```bash
php artisan tinker

# Inside tinker:
Schema::getColumnListing('products')
// Returns array of all columns

DB::getSchemaBuilder()->getColumns('orders')
// Returns detailed column info
```

---

## 💾 Backup & Recovery

### Create Database Backup
```bash
# MySQL dump
mysqldump -u root -p ecommerce_api > backup.sql

# PowerShell
mysqldump -u root -p ecommerce_api | Out-File backup.sql
```

### Restore from Backup
```bash
# From SQL file
mysql -u root -p ecommerce_api < backup.sql

# PowerShell
Get-Content backup.sql | mysql -u root -p ecommerce_api
```

---

## 📊 Common Database Queries for Reporting

### Monthly Revenue
```php
$monthlyRevenue = DB::table('orders')
    ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total')
    ->where('payment_status', 'paid')
    ->groupByRaw('YEAR(created_at), MONTH(created_at)')
    ->orderBy('year')
    ->orderBy('month')
    ->get();
```

### Orders Per Customer
```php
$ordersPerCustomer = Order::selectRaw('user_id, COUNT(*) as order_count, SUM(total_amount) as total_spent')
    ->groupBy('user_id')
    ->orderBy('total_spent', 'desc')
    ->get();
```

### Most Popular Products
```php
$popular = DB::table('order_items')
    ->join('products', 'order_items.product_id', '=', 'products.id')
    ->selectRaw('products.name, SUM(order_items.quantity) as total_sold, SUM(order_items.subtotal) as revenue')
    ->groupBy('products.id', 'products.name')
    ->orderBy('total_sold', 'desc')
    ->limit(10)
    ->get();
```

### Customer Lifetime Value
```php
$clv = Order::selectRaw('user_id, COUNT(*) as orders, SUM(total_amount) as lifetime_value')
    ->where('payment_status', 'paid')
    ->groupBy('user_id')
    ->having('lifetime_value', '>', 100)
    ->get();
```

---

## 🔒 Data Integrity Checks

### Orphaned Records (Orders without User)
```php
Order::whereNotIn('user_id', User::pluck('id'))->get()
```

### Orphaned OrderItems
```php
OrderItem::whereNotIn('order_id', Order::pluck('id'))->get()
OrderItem::whereNotIn('product_id', Product::pluck('id'))->get()
```

### Products with Invalid Category
```php
Product::whereNotIn('category_id', Category::pluck('id'))->get()
```

### Fix Orphaned Records
```php
// Delete orphaned order items
OrderItem::whereNotIn('order_id', Order::pluck('id'))->delete()

// Delete orphaned orders
Order::whereNotIn('user_id', User::pluck('id'))->delete()
```

---

## 📈 Database Size Optimization

### Check Table Sizes
```bash
# MySQL command
SELECT 
    TABLE_NAME, 
    ROUND(((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024), 2) AS MB 
FROM 
    INFORMATION_SCHEMA.TABLES 
WHERE 
    TABLE_SCHEMA = 'ecommerce_api' 
ORDER BY 
    MB DESC;
```

### Archive Old Orders (Annual)
```php
// Move orders older than 2 years to archive table
Order::where('created_at', '<', now()->subYears(2))->delete()
```

### Optimize Tables
```bash
# MySQL
OPTIMIZE TABLE products;
OPTIMIZE TABLE orders;
OPTIMIZE TABLE order_items;
```

---

## 🔐 Transactions & Atomicity

### Example: Order Creation (Atomic)
```php
DB::transaction(function () {
    // All steps must succeed or all roll back
    
    // Step 1: Create order
    $order = Order::create([...]);
    
    // Step 2: Create items
    foreach ($items as $item) {
        OrderItem::create([...]);
    }
    
    // Step 3: Update stock
    foreach ($items as $item) {
        $product->reduceStock($item['quantity']);
    }
    
    // All succeed, or all fail if error occurs
});
```

---

**Database architecture complete! Ready for production use.** 🎉
