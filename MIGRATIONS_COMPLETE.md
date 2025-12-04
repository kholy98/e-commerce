# Complete Migrations Guide

All migrations are now synced with the business logic and models. Here's what each migration contains:

## Core Migrations (Updated)

### 1. **Users Table** (`0001_01_01_000000_create_users_table.php`)
Stores customer accounts with extended fields for shipping.

**Fields:**
- `id` - Primary key
- `name` - Customer name
- `email` - Unique email
- `email_verified_at` - Email verification timestamp
- `password` - Hashed password
- `remember_token` - Laravel token
- `phone` - Customer phone number (new)
- `address` - Street address (new)
- `city` - City (new)
- `zip_code` - Postal code (new)
- `country` - Country (new)
- `timestamps` - created_at, updated_at

**Indexes:** email (unique), id (primary)

---

### 2. **Categories Table** (`2025_12_03_153758_create_categories_table.php`)
Product categories with SEO-friendly slugs.

**Fields:**
- `id` - Primary key
- `name` - Category name (unique)
- `description` - Category description
- `slug` - URL-friendly slug (unique)
- `is_active` - Active status (indexed)
- `sort_order` - Display order
- `timestamps` - created_at, updated_at

**Indexes:** id, name (unique), slug (unique), is_active

**Sample Data:**
```
Electronics, Clothing, Books, Home & Garden, Sports
```

---

### 3. **Products Table** (`2025_12_03_153806_create_products_table.php`)
Product catalog with inventory management.

**Fields:**
- `id` - Primary key
- `name` - Product name
- `description` - Product description
- `sku` - Stock Keeping Unit (unique)
- `price` - Selling price (decimal 10,2)
- `cost` - Cost price (decimal 10,2)
- `stock` - Current stock quantity
- `category_id` - Foreign key to categories
- `is_active` - Active status (indexed)
- `published_at` - Publication date
- `timestamps` - created_at, updated_at

**Indexes:** id, category_id, is_active, sku

**Constraints:**
- Foreign key: category_id → categories.id (cascade delete)

**Sample Data:**
```
7 products: Laptop, Mouse, Dress, Novel, Plant, Shoes, Bookshelf
Prices: $29.99 - $199.99
Stock: 10-100 units
```

---

### 4. **Orders Table** (`2025_12_03_153821_create_orders_table.php`)
Customer orders with complete lifecycle tracking.

**Fields:**
- `id` - Primary key
- `order_number` - Unique order number (e.g., ORD-20250104120530-A1B2C3)
- `user_id` - Foreign key to users
- `status` - Enum: pending, processing, shipped, delivered, cancelled (indexed)
- `payment_status` - Enum: pending, paid, failed, refunded (indexed)
- `subtotal` - Order subtotal (decimal 12,2)
- `tax` - Tax amount: 10% of subtotal (decimal 12,2)
- `shipping_cost` - Shipping: 0 if subtotal > $100, else $10 (decimal 12,2)
- `total_amount` - Total: subtotal + tax + shipping (decimal 12,2)
- `shipping_address` - JSON array with address details
- `notes` - Order notes
- `shipped_at` - Shipment timestamp
- `delivered_at` - Delivery timestamp
- `cancelled_at` - Cancellation timestamp
- `timestamps` - created_at, updated_at

**Indexes:** id, user_id, status, payment_status, created_at

**Constraints:**
- Foreign key: user_id → users.id (cascade delete)

**Order Status Flow:**
```
pending → processing → shipped → delivered ✓
              ↓
           cancelled (with refund)
```

**Sample Calculations:**
```
Subtotal: $150.00
Tax (10%): $15.00
Shipping: $0 (free, > $100)
Total: $165.00
```

---

### 5. **Order Items Table** (`2025_12_03_153816_create_order_items_table.php`)
Individual items within orders.

**Fields:**
- `id` - Primary key
- `order_id` - Foreign key to orders
- `product_id` - Foreign key to products
- `quantity` - Item quantity (integer)
- `price` - Price at time of purchase (decimal 10,2)
- `subtotal` - quantity × price (decimal 12,2)
- `timestamps` - created_at, updated_at

**Indexes:** id, order_id, product_id

**Constraints:**
- Foreign key: order_id → orders.id (cascade delete)
- Foreign key: product_id → products.id (cascade delete)

---

## Additional Migrations (New)

### 6. **Order Audit Logs** (`2025_12_04_000001_create_order_audit_logs_table.php`)
Tracks all changes to orders for compliance and debugging.

**Fields:**
- `id` - Primary key
- `order_id` - Foreign key to orders
- `user_id` - Admin/user who made the change
- `action` - Action type: created, status_changed, payment_updated, cancelled
- `old_value` - Previous value
- `new_value` - New value
- `metadata` - JSON additional context
- `ip_address` - IP address of who made change
- `timestamps` - created_at, updated_at

**Indexes:** id, order_id, user_id, action, created_at

**Use Cases:**
- Track who changed order status
- Audit trail for disputes
- Debug payment issues

---

### 7. **Product Reviews** (`2025_12_04_000002_create_product_reviews_table.php`)
Customer product reviews and ratings.

**Fields:**
- `id` - Primary key
- `product_id` - Foreign key to products
- `user_id` - Foreign key to users
- `rating` - Rating 1-5 stars
- `title` - Review title
- `comment` - Review text
- `is_verified_purchase` - Whether user purchased this product
- `is_approved` - Admin approval status (indexed)
- `helpful_count` - Number of helpful votes
- `timestamps` - created_at, updated_at

**Constraints:**
- Unique: (product_id, user_id) - One review per user per product
- Foreign keys with cascade delete

**Indexes:** product_id, user_id, is_approved, created_at

---

### 8. **Inventory Logs** (`2025_12_04_000003_create_inventory_logs_table.php`)
Complete history of stock changes.

**Fields:**
- `id` - Primary key
- `product_id` - Foreign key to products
- `quantity_before` - Stock before change
- `quantity_after` - Stock after change
- `quantity_changed` - Difference
- `action` - Action type: order_created, order_cancelled, stock_adjustment, manual_update (indexed)
- `reference_type` - Type of reference: order, manual
- `reference_id` - Reference ID (e.g., order_id)
- `notes` - Additional notes
- `ip_address` - IP address
- `timestamps` - created_at, updated_at

**Example Entry:**
```
Product: Laptop (ID: 1)
Action: order_created
Before: 50 units
After: 49 units
Changed: -1
Reference: Order #ORD-20250104120530-A1B2C3
```

---

### 9. **Payment Transactions** (`2025_12_04_000004_create_payment_transactions_table.php`)
Records all payment attempts and completions.

**Fields:**
- `id` - Primary key
- `order_id` - Foreign key to orders
- `amount` - Transaction amount (decimal 12,2)
- `status` - Status: pending, completed, failed, refunded (indexed)
- `payment_method` - credit_card, debit_card, paypal, bank_transfer, other
- `transaction_id` - Payment gateway transaction ID (unique)
- `reference_number` - Internal reference
- `gateway_response` - JSON response from payment gateway
- `failure_reason` - Reason if failed
- `ip_address` - Customer IP address
- `processed_at` - Completion timestamp
- `timestamps` - created_at, updated_at

**Indexes:** id, order_id, status, created_at

---

### 10. **Wishlist** (`2025_12_04_000005_create_wishlist_table.php`)
User favorite products.

**Fields:**
- `id` - Primary key
- `user_id` - Foreign key to users
- `product_id` - Foreign key to products
- `timestamps` - created_at, updated_at

**Constraints:**
- Unique: (user_id, product_id) - One wishlist entry per user per product
- Cascade delete on user/product delete

**Indexes:** user_id, product_id

---

### 11. **Shipments** (`2025_12_04_000006_create_shipments_table.php`)
Shipping and tracking information.

**Fields:**
- `id` - Primary key
- `order_id` - Foreign key to orders
- `tracking_number` - Carrier tracking number (unique)
- `status` - Status: pending, shipped, in_transit, delivered, failed (indexed)
- `carrier` - Carrier: ups, fedex, dhl, etc
- `carrier_url` - URL to track on carrier website
- `tracking_history` - JSON array of tracking updates
- `shipping_cost` - Shipping cost (decimal 10,2)
- `shipped_at` - When shipped
- `delivered_at` - When delivered
- `expected_delivery_at` - Expected delivery date
- `notes` - Shipping notes
- `timestamps` - created_at, updated_at

**Indexes:** id, order_id, status, shipped_at

**Tracking History Example:**
```json
[
  {"status": "shipped", "location": "New York", "timestamp": "2025-01-04 10:00"},
  {"status": "in_transit", "location": "New Jersey", "timestamp": "2025-01-04 15:30"},
  {"status": "delivered", "location": "Customer Address", "timestamp": "2025-01-05 09:00"}
]
```

---

### 12. **Discount Codes** (`2025_12_04_000007_create_discount_codes_table.php`)
Promotional codes and discounts.

**Fields:**
- `id` - Primary key
- `code` - Discount code (unique)
- `description` - Description
- `discount_type` - Type: percentage, fixed
- `discount_value` - Discount amount/percentage
- `max_discount` - Maximum discount cap (for percentage)
- `minimum_order_amount` - Minimum order to apply
- `usage_limit` - Total number of times code can be used
- `usage_count` - Current usage count
- `usage_per_customer` - Times per customer
- `is_active` - Active status (indexed)
- `starts_at` - Start date (indexed)
- `ends_at` - Expiration date (indexed)
- `timestamps` - created_at, updated_at

**Examples:**
```
Code: SUMMER20
Type: Percentage
Value: 20%
Max Discount: $50
Min Order: $100
Valid: 2025-01-01 to 2025-03-31

Code: SAVE10
Type: Fixed
Value: $10
Min Order: $50
Valid: Always
```

---

### 13. **Customer Addresses** (`2025_12_04_000008_create_customer_addresses_table.php`)
Multiple delivery addresses per customer.

**Fields:**
- `id` - Primary key
- `user_id` - Foreign key to users
- `label` - Label: home, work, etc
- `name` - Recipient name
- `phone` - Recipient phone
- `address` - Street address
- `city` - City
- `zip_code` - Postal code
- `country` - Country
- `state` - State/Province
- `is_default` - Default shipping address
- `is_billing` - Billing address flag
- `is_shipping` - Shipping address flag
- `timestamps` - created_at, updated_at

**Indexes:** id, user_id, is_default

---

## Migration Execution Guide

### Fresh Setup (Development)
```bash
# Reset database and run all migrations with seeds
php artisan migrate:fresh --seed

# Output:
# Dropped all tables successfully.
# Migration table created successfully.
# Migrating: 0001_01_01_000000_create_users_table
# Migrated:  0001_01_01_000000_create_users_table
# Migrating: 0001_01_01_000001_create_cache_table
# Migrated:  0001_01_01_000001_create_cache_table
# ... (continues for all 13 migrations)
# Seeding: DatabaseSeeder
# Seeding: CategorySeeder
# Seeding: ProductSeeder
```

### Incremental Migration (Production)
```bash
# Run pending migrations only
php artisan migrate

# Show migration status
php artisan migrate:status

# Rollback last batch
php artisan migrate:rollback

# Rollback all
php artisan migrate:reset

# Refresh (rollback + migrate)
php artisan migrate:refresh
```

### Specific Migration Operations
```bash
# Run specific migration
php artisan migrate --path=database/migrations/2025_12_04_000001_create_order_audit_logs_table.php

# Rollback to specific migration
php artisan migrate:rollback --step=2

# Create new migration
php artisan make:migration create_table_name
```

---

## Database Relationships

### Entity Relationship Diagram
```
Users (1) ──→ (M) Orders
  │
  ├──→ (M) Product Reviews
  ├──→ (M) Wishlist Items
  └──→ (M) Customer Addresses

Categories (1) ──→ (M) Products

Products (1) ──→ (M) Order Items
  │
  ├──→ (M) Product Reviews
  ├──→ (M) Inventory Logs
  └──→ (M) Wishlist Items

Orders (1) ──→ (M) Order Items
  │
  ├──→ (1) User
  ├──→ (M) Order Audit Logs
  ├──→ (M) Payment Transactions
  └──→ (1) Shipment

Discount Codes (M) ──→ (M) Orders (pivot table if needed)
```

---

## Data Integrity & Constraints

### Cascade Delete Rules
- **Users deleted**: Orders, Order Items, Addresses, Reviews, Wishlist deleted
- **Categories deleted**: Products deleted (which cascade to Order Items)
- **Products deleted**: Order Items, Reviews, Inventory Logs, Wishlist deleted
- **Orders deleted**: Order Items, Audit Logs, Payments, Shipments deleted

### Unique Constraints
- `users.email` - Unique email per account
- `categories.name` - Unique category name
- `categories.slug` - Unique URL slug
- `products.sku` - Unique stock keeping unit
- `orders.order_number` - Unique order identifier
- `payment_transactions.transaction_id` - Unique payment ID
- `product_reviews.(product_id, user_id)` - One review per user per product
- `wishlist.(user_id, product_id)` - One wishlist entry per user per product
- `shipments.tracking_number` - Unique tracking number
- `discount_codes.code` - Unique promotion code

### Indexes for Performance
```sql
-- Faster order lookups
INDEX idx_orders_user_id (user_id)
INDEX idx_orders_status (status)
INDEX idx_orders_payment_status (payment_status)
INDEX idx_orders_created_at (created_at)

-- Faster product queries
INDEX idx_products_category_id (category_id)
INDEX idx_products_is_active (is_active)
INDEX idx_products_sku (sku)

-- Faster filtering
INDEX idx_order_items_order_id (order_id)
INDEX idx_order_items_product_id (product_id)
INDEX idx_inventory_logs_product_id (product_id)
INDEX idx_inventory_logs_action (action)
```

---

## Verification Commands

### Check All Tables Created
```bash
php artisan tinker

# List all tables
>>> collect(\DB::select('SHOW TABLES'))->pluck('Tables_in_database');

# Output:
Illuminate\Support\Collection {
  0: "users"
  1: "categories"
  2: "products"
  3: "orders"
  4: "order_items"
  5: "order_audit_logs"
  6: "product_reviews"
  7: "inventory_logs"
  8: "payment_transactions"
  9: "wishlist"
  10: "shipments"
  11: "discount_codes"
  12: "customer_addresses"
}
```

### Check Table Structure
```bash
php artisan tinker

# Check columns in products table
>>> \Schema::getColumns('products');

# Check indexes
>>> \Schema::getIndexes('orders');
```

### Count Records
```bash
# Users
>>> App\Models\User::count();

# Products
>>> App\Models\Product::count();

# Categories
>>> App\Models\Category::count();

# Orders
>>> App\Models\Order::count();
```

---

## Migration Sync with Business Logic

### Pricing Logic
```
Order Total = Subtotal + Tax + Shipping

Where:
- Subtotal = Sum of all item subtotals
- Tax = Subtotal × 0.10 (10% tax rate)
- Shipping = $0 (if subtotal > $100) else $10
- Item Subtotal = quantity × price
```

### Inventory Management
```
CREATE order → Reduce stock
CANCEL order → Restore stock
REVIEW inventory → Check stock_after
```

### Order Lifecycle
```
pending → processing → shipped → delivered ✓
   ↓                    ↓
cancelled (with refund, stock restored)
```

### Payment Status
```
pending → paid ✓
   ↓
 failed → retry or refund
```

---

## Troubleshooting

### Migration Won't Run
```bash
# Check if table already exists
php artisan tinker
>>> \Schema::hasTable('orders');

# Drop specific table
>>> \DB::statement('DROP TABLE orders');

# Re-run migration
exit
php artisan migrate
```

### Foreign Key Constraint Error
```bash
# Solution: Ensure parent tables exist
# Run in order:
# 1. Users
# 2. Categories
# 3. Products (depends on categories)
# 4. Orders (depends on users)
# 5. Order Items (depends on orders and products)

# Check foreign key constraints
php artisan tinker
>>> \DB::select("SELECT CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = 'database_name'");
```

### Reset Development Database
```bash
# Complete fresh start
php artisan migrate:fresh --seed

# Or step by step
php artisan migrate:reset      # Rollback all
php artisan migrate            # Run all migrations
php artisan db:seed            # Seed data
```

---

## Performance Optimization

### Indexes by Query Pattern
```sql
-- Find customer orders by date
ALTER TABLE orders ADD INDEX idx_user_created (user_id, created_at);

-- Find low stock products
ALTER TABLE products ADD INDEX idx_stock_active (stock, is_active);

-- Search order history
ALTER TABLE orders ADD INDEX idx_order_number (order_number);

-- Audit trail queries
ALTER TABLE order_audit_logs ADD INDEX idx_order_action (order_id, action);

-- Inventory tracking
ALTER TABLE inventory_logs ADD INDEX idx_product_date (product_id, created_at);
```

### Query Optimization
```php
// ✓ Good: Uses indexes
Order::where('user_id', $userId)
      ->where('status', 'pending')
      ->orderBy('created_at', 'desc')
      ->get();

// ✗ Bad: Full table scan
Order::where('status', 'pending')
      ->where('total_amount', '>', 100)
      ->get();
// Add index: ALTER TABLE orders ADD INDEX idx_status_amount (status, total_amount);
```

