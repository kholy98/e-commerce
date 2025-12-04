# Migrations Quick Reference

## Summary of All 13 Migrations

| # | Migration File | Table | Purpose | Key Fields |
|---|---|---|---|---|
| 1 | `0001_01_01_000000_create_users_table.php` | `users` | Customer accounts | id, name, email, phone, address, city, zip_code, country |
| 2 | `0001_01_01_000001_create_cache_table.php` | `cache` | Laravel caching | key, value, expiration |
| 3 | `0001_01_01_000002_create_jobs_table.php` | `jobs` | Queue jobs | id, queue, payload, attempts, reserved_at, available_at, created_at |
| 4 | `2025_12_03_152833_create_personal_access_tokens_table.php` | `personal_access_tokens` | API tokens (Sanctum) | id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at |
| 5 | `2025_12_03_153235_create_permission_tables.php` | `roles`, `permissions`, `role_has_permissions`, etc | Laravel Permissions | Various |
| 6 | `2025_12_03_153418_create_media_table.php` | `media` | Media library | id, model_id, model_type, name, file_name, mime_type, disk, size |
| 7 | `2025_12_03_153758_create_categories_table.php` | `categories` | Product categories | id, name, description, slug, is_active, sort_order |
| 8 | `2025_12_03_153806_create_products_table.php` | `products` | Product catalog | id, name, sku, price, cost, stock, category_id, is_active |
| 9 | `2025_12_03_153816_create_order_items_table.php` | `order_items` | Order items (line items) | id, order_id, product_id, quantity, price, subtotal |
| 10 | `2025_12_03_153821_create_orders_table.php` | `orders` | Customer orders | id, order_number, user_id, status, payment_status, totals, shipping_address |
| 11 | `2025_12_04_000001_create_order_audit_logs_table.php` | `order_audit_logs` | Order change tracking | id, order_id, user_id, action, old_value, new_value |
| 12 | `2025_12_04_000002_create_product_reviews_table.php` | `product_reviews` | Customer reviews | id, product_id, user_id, rating, title, comment, is_approved |
| 13 | `2025_12_04_000003_create_inventory_logs_table.php` | `inventory_logs` | Stock change history | id, product_id, quantity_before, quantity_after, action, reference_id |
| 14 | `2025_12_04_000004_create_payment_transactions_table.php` | `payment_transactions` | Payment records | id, order_id, amount, status, payment_method, transaction_id |
| 15 | `2025_12_04_000005_create_wishlist_table.php` | `wishlist` | User favorites | id, user_id, product_id |
| 16 | `2025_12_04_000006_create_shipments_table.php` | `shipments` | Shipping tracking | id, order_id, tracking_number, status, carrier, shipped_at, delivered_at |
| 17 | `2025_12_04_000007_create_discount_codes_table.php` | `discount_codes` | Promo codes | id, code, discount_type, discount_value, usage_limit, is_active |
| 18 | `2025_12_04_000008_create_customer_addresses_table.php` | `customer_addresses` | Multiple addresses | id, user_id, label, name, phone, address, city, zip_code, country |

---

## E-Commerce Core Tables (For Order Processing)

### Essential Tables (Must Have)
1. ✅ `users` - Customer accounts
2. ✅ `categories` - Product categories
3. ✅ `products` - Product catalog
4. ✅ `orders` - Customer orders
5. ✅ `order_items` - Order line items

### Enhanced Tables (Should Have)
6. ✅ `order_audit_logs` - Track changes
7. ✅ `inventory_logs` - Stock history
8. ✅ `payment_transactions` - Payment tracking
9. ✅ `shipments` - Shipping tracking
10. ✅ `customer_addresses` - Multiple addresses

### Optional Tables (Nice to Have)
11. ✅ `product_reviews` - Customer ratings
12. ✅ `wishlist` - User favorites
13. ✅ `discount_codes` - Promotions

### Framework Tables (Laravel)
14. ✅ `cache` - Cache storage
15. ✅ `jobs` - Queue jobs
16. ✅ `personal_access_tokens` - API auth (Sanctum)
17. ✅ `roles`, `permissions` - Authorization

---

## Running Migrations

### Option 1: Fresh Setup (Development)
```bash
php artisan migrate:fresh --seed
```
✓ Drops all tables
✓ Re-runs all migrations
✓ Seeds sample data

### Option 2: Incremental (Production)
```bash
php artisan migrate
```
✓ Runs only pending migrations
✓ Safe for live databases

### Option 3: Specific Migration
```bash
php artisan migrate --path=database/migrations/2025_12_03_153806_create_products_table.php
```

---

## Key Database Relationships

```
users (1) ──M──→ orders (1) ──M──→ order_items (M) ──1──→ products (M) ──1──→ categories
  │
  ├─M─→ customer_addresses
  ├─M─→ product_reviews
  └─M─→ wishlist
  
orders ──1──→ order_audit_logs
         ──1──→ payment_transactions
         ──1──→ shipments

products ──1──→ inventory_logs
```

---

## Field Types & Constraints

### Decimal Fields (Financial)
- `price`, `cost`: `decimal(10, 2)` - Up to $9,999,999.99
- `subtotal`, `tax`, `total_amount`: `decimal(12, 2)` - Up to $999,999,999.99

### Status Enums
- **Order Status**: pending, processing, shipped, delivered, cancelled
- **Payment Status**: pending, paid, failed, refunded
- **Shipment Status**: pending, shipped, in_transit, delivered, failed
- **Payment Methods**: credit_card, debit_card, paypal, bank_transfer, other
- **Discount Type**: percentage, fixed
- **Inventory Action**: order_created, order_cancelled, stock_adjustment, manual_update

### Indexed Fields (Performance)
- Foreign keys: `user_id`, `product_id`, `order_id`, `category_id`
- Status fields: `status`, `payment_status`, `is_active`, `is_approved`
- Date fields: `created_at`, `updated_at`, `published_at`, `shipped_at`

---

## Common Database Operations

### Check Current Schema
```bash
php artisan tinker

# List all tables
>>> collect(\DB::select('SHOW TABLES'))->pluck('Tables_in_database')->all();

# Show columns in a table
>>> \Schema::getColumns('products');

# Show table info
>>> \DB::select('DESCRIBE products');
```

### Test Data Queries
```bash
php artisan tinker

# Create sample order
>>> $user = User::first();
>>> $order = $user->orders()->create([...]);

# Check relationships
>>> $user->orders()->count();
>>> Order::with('items.product')->get();

# Aggregate queries
>>> Order::where('status', 'pending')->count();
>>> Product::where('stock', '<', 10)->get();
```

---

## Migration Troubleshooting

| Issue | Solution |
|---|---|
| `SQLSTATE[42S02]: Table not found` | Run `php artisan migrate` |
| `Unique constraint violation` | Check for duplicate data; use `migrate:fresh` on dev |
| `Foreign key constraint fails` | Parent table doesn't exist; run migrations in order |
| `Column already exists` | Already migrated; use `migrate:rollback` then re-run |
| `Memory exhausted` | Reduce seeding data or increase PHP memory |

---

## Setup Commands Sequence

```bash
# 1. Create database
# MySQL: CREATE DATABASE ecommerce_db;

# 2. Update .env with database credentials
# DB_DATABASE=ecommerce_db
# DB_USERNAME=root
# DB_PASSWORD=

# 3. Run migrations
php artisan migrate:fresh --seed

# 4. Verify setup
php artisan tinker
>>> User::count()     # Should see seeded users
>>> Product::count()  # Should see 7 products
>>> Category::count() # Should see 5 categories

# 5. Start server
php artisan serve

# 6. Test API
# GET http://localhost:8000/api/products
```

---

## Database Backup & Restore

### Backup
```bash
# Full database backup
mysqldump -u root -p ecommerce_db > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup specific table
mysqldump -u root -p ecommerce_db products > products_backup.sql
```

### Restore
```bash
# Restore from backup
mysql -u root -p ecommerce_db < backup_20250104_120530.sql

# Or in Laravel
php artisan migrate:refresh --seed
```

---

## Production Checklist

- [ ] All migrations run successfully: `php artisan migrate:status`
- [ ] Foreign keys working: Test referential integrity
- [ ] Indexes created: Check with `SHOW INDEX FROM table_name`
- [ ] Data types correct: Verify decimal fields for money
- [ ] Constraints enforced: Test unique/not null
- [ ] Seed data cleared: Remove sample data before launch
- [ ] Backups scheduled: Set up automated database backups
- [ ] Performance optimized: Run with `php artisan query:monitor`

