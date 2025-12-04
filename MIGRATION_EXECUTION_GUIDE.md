# Migration Execution Guide - Step by Step

## Pre-Migration Checklist

✅ Database created in MySQL  
✅ .env file configured with database credentials  
✅ Laravel installed with Composer  
✅ All migration files present in `database/migrations/`  

---

## Step 1: Verify Database Connection

```bash
# Test connection with Artisan
php artisan db:show

# Expected output:
# ┌─────────────────┬─────────────────────────────────┐
# │ Database        │ ecommerce_db                    │
# │ Host            │ 127.0.0.1                       │
# │ Port            │ 3306                            │
# │ Username        │ root                            │
# │ URL             │ mysql://root@127.0.0.1/... │
# └─────────────────┴─────────────────────────────────┘
```

If error: Check `.env` file database settings

---

## Step 2: Run Fresh Migrations (Recommended for Development)

### Option A: With Sample Data (Recommended)
```bash
php artisan migrate:fresh --seed
```

**What this does:**
1. Drops all tables
2. Runs all 18 migrations
3. Seeds sample data (5 categories, 7 products, 1 test user)
4. Takes ~5-10 seconds

**Output you should see:**
```
Dropped all tables successfully.
Migration table created successfully.
Migrating: 0001_01_01_000000_create_users_table
Migrated:  0001_01_01_000000_create_users_table (71.34ms)
Migrating: 0001_01_01_000001_create_cache_table
Migrated:  0001_01_01_000001_create_cache_table (45.12ms)
Migrating: 0001_01_01_000002_create_jobs_table
Migrated:  0001_01_01_000002_create_jobs_table (38.92ms)
Migrating: 2025_12_03_152833_create_personal_access_tokens_table
Migrated:  2025_12_03_152833_create_personal_access_tokens_table (32.45ms)
Migrating: 2025_12_03_153235_create_permission_tables
Migrated:  2025_12_03_153235_create_permission_tables (125.78ms)
Migrating: 2025_12_03_153418_create_media_table
Migrated:  2025_12_03_153418_create_media_table (48.23ms)
Migrating: 2025_12_03_153758_create_categories_table
Migrated:  2025_12_03_153758_create_categories_table (19.34ms)
Migrating: 2025_12_03_153806_create_products_table
Migrated:  2025_12_03_153806_create_products_table (28.56ms)
Migrating: 2025_12_03_153816_create_order_items_table
Migrated:  2025_12_03_153816_create_order_items_table (22.14ms)
Migrating: 2025_12_03_153821_create_orders_table
Migrated:  2025_12_03_153821_create_orders_table (31.92ms)
Migrating: 2025_12_04_000001_create_order_audit_logs_table
Migrated:  2025_12_04_000001_create_order_audit_logs_table (18.45ms)
Migrating: 2025_12_04_000002_create_product_reviews_table
Migrated:  2025_12_04_000002_create_product_reviews_table (21.67ms)
Migrating: 2025_12_04_000003_create_inventory_logs_table
Migrated:  2025_12_04_000003_create_inventory_logs_table (24.89ms)
Migrating: 2025_12_04_000004_create_payment_transactions_table
Migrated:  2025_12_04_000004_create_payment_transactions_table (29.34ms)
Migrating: 2025_12_04_000005_create_wishlist_table
Migrated:  2025_12_04_000005_create_wishlist_table (16.78ms)
Migrating: 2025_12_04_000006_create_shipments_table
Migrated:  2025_12_04_000006_create_shipments_table (27.42ms)
Migrating: 2025_12_04_000007_create_discount_codes_table
Migrated:  2025_12_04_000007_create_discount_codes_table (33.21ms)
Migrating: 2025_12_04_000008_create_customer_addresses_table
Migrated:  2025_12_04_000008_create_customer_addresses_table (19.87ms)
Seeding: DatabaseSeeder
Seeding: CategorySeeder
Seeded:  CategorySeeder (1.23ms)
Seeding: ProductSeeder
Seeded:  ProductSeeder (2.45ms)
Database seeding completed successfully.
```

### Option B: Without Seed Data
```bash
php artisan migrate:fresh
```

---

## Step 3: Verify Migrations

### Check Migration Status
```bash
php artisan migrate:status
```

**Expected output:**
```
 Migration Name .................................. Batch / Status
  0001_01_01_000000_create_users_table ............. [1] Ran
  0001_01_01_000001_create_cache_table ............. [1] Ran
  0001_01_01_000002_create_jobs_table .............. [1] Ran
  2025_12_03_152833_create_personal_access_tokens_table .. [1] Ran
  2025_12_03_153235_create_permission_tables ....... [1] Ran
  2025_12_03_153418_create_media_table ............. [1] Ran
  2025_12_03_153758_create_categories_table ........ [1] Ran
  2025_12_03_153806_create_products_table .......... [1] Ran
  2025_12_03_153816_create_order_items_table ....... [1] Ran
  2025_12_03_153821_create_orders_table ............ [1] Ran
  2025_12_04_000001_create_order_audit_logs_table .. [1] Ran
  2025_12_04_000002_create_product_reviews_table ... [1] Ran
  2025_12_04_000003_create_inventory_logs_table .... [1] Ran
  2025_12_04_000004_create_payment_transactions_table [1] Ran
  2025_12_04_000005_create_wishlist_table .......... [1] Ran
  2025_12_04_000006_create_shipments_table ......... [1] Ran
  2025_12_04_000007_create_discount_codes_table .... [1] Ran
  2025_12_04_000008_create_customer_addresses_table  [1] Ran
```

All should show `[1] Ran`

### Check All Tables in Database
```bash
php artisan tinker
>>> collect(\DB::select('SHOW TABLES'))->pluck('Tables_in_database');
```

**Expected output (18 tables):**
```
Illuminate\Support\Collection {
  0: "cache"
  1: "cache_locks"
  2: "categories"
  3: "customer_addresses"
  4: "discount_codes"
  5: "failed_jobs"
  6: "inventory_logs"
  7: "jobs"
  8: "media"
  9: "migrations"
  10: "order_audit_logs"
  11: "order_items"
  12: "orders"
  13: "payment_transactions"
  14: "personal_access_tokens"
  15: "product_reviews"
  16: "products"
  17: "role_has_permissions"
  18: "shipments"
  19: "users"
  20: "wishlist"
}
```

---

## Step 4: Verify Sample Data

### Check Record Counts
```bash
php artisan tinker

# Check users
>>> User::count()
=> 1

# Check categories
>>> Category::count()
=> 5

# Check products
>>> Product::count()
=> 7

# Check categories with products
>>> Category::with('products')->get();

# Check test user
>>> User::first();

# Check a product
>>> Product::first();
```

### Sample User Created
```
Email: user@example.com
Password: password
Name: John Doe
```

### Sample Categories
```
1. Electronics
2. Clothing
3. Books
4. Home & Garden
5. Sports
```

### Sample Products
```
1. Laptop (Electronics) - $999.99 - Stock: 10
2. Mouse (Electronics) - $29.99 - Stock: 50
3. Dress (Clothing) - $49.99 - Stock: 20
4. Novel (Books) - $19.99 - Stock: 100
5. Plant (Home & Garden) - $24.99 - Stock: 15
6. Shoes (Clothing) - $79.99 - Stock: 30
7. Bookshelf (Home & Garden) - $199.99 - Stock: 5
```

---

## Step 5: Start Development Server

```bash
php artisan serve
```

**Output:**
```
   INFO  Server running on [http://127.0.0.1:8000].

  Press Ctrl+C to stop the server
```

---

## Step 6: Test API Endpoints

### Test 1: Get All Products
```bash
# Using cURL
curl http://127.0.0.1:8000/api/products

# Or in browser
http://127.0.0.1:8000/api/products
```

**Expected response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Laptop",
      "sku": "LAPTOP001",
      "price": "999.99",
      "stock": 10,
      "category": {
        "id": 1,
        "name": "Electronics"
      }
    },
    ...
  ],
  "message": "Products retrieved successfully"
}
```

### Test 2: Get Single Product
```bash
curl http://127.0.0.1:8000/api/products/1
```

### Test 3: Get Categories
```bash
curl http://127.0.0.1:8000/api/categories
```

---

## Alternative: Incremental Migration (Production)

For production environments where database already exists:

```bash
# Run only pending migrations (safe)
php artisan migrate

# This will not drop tables, just add new ones
# Use this after deploying code changes
```

---

## Rollback Operations (If Needed)

### Rollback Last Migration Batch
```bash
php artisan migrate:rollback
```

### Rollback Specific Number of Steps
```bash
php artisan migrate:rollback --step=2
```

### Rollback All Migrations
```bash
php artisan migrate:reset
```

### Rollback and Re-run (Refresh)
```bash
php artisan migrate:refresh
```

### Complete Reset with Seed
```bash
php artisan migrate:fresh --seed
```

---

## Troubleshooting

### Error: "No such file or directory"
**Cause:** Database does not exist  
**Solution:**
```bash
# Create database manually
mysql -u root -p
> CREATE DATABASE ecommerce_db;
> EXIT;

# Then run migrations
php artisan migrate:fresh --seed
```

### Error: "Unknown database"
**Cause:** Wrong database name in .env  
**Solution:**
```bash
# Check .env file
cat .env | grep DB_

# Update if needed
# DB_DATABASE=ecommerce_db
# DB_USERNAME=root
# DB_PASSWORD=
```

### Error: "Access denied for user"
**Cause:** Wrong username/password in .env  
**Solution:**
```bash
# Verify MySQL credentials work
mysql -u root -p -e "SELECT 1"

# Update .env accordingly
```

### Error: "Foreign key constraint fails"
**Cause:** Parent table doesn't exist  
**Solution:**
```bash
# Run migrations in order
php artisan migrate:fresh

# Or manually:
php artisan migrate --step
```

### Error: "Table already exists"
**Cause:** Previous migration data exists  
**Solution:**
```bash
# Use fresh to reset
php artisan migrate:fresh --seed

# Or drop and recreate:
php artisan migrate:reset
php artisan migrate:fresh --seed
```

---

## Verification Checklist

After migration completes, verify:

- [ ] All 18 migrations show "Ran" status
- [ ] 18+ tables created in database
- [ ] Users table has 1 test user
- [ ] Categories table has 5 records
- [ ] Products table has 7 records
- [ ] API endpoints respond correctly
- [ ] Foreign keys working (no orphaned records)
- [ ] Indexes created (check with SHOW INDEX)

---

## Production Deployment Steps

1. **Backup existing database:**
   ```bash
   mysqldump -u root -p ecommerce_db > backup_$(date +%Y%m%d_%H%M%S).sql
   ```

2. **Push code changes:**
   ```bash
   git push origin main
   ```

3. **SSH into server:**
   ```bash
   ssh user@production-server.com
   ```

4. **Pull latest code:**
   ```bash
   git pull origin main
   ```

5. **Run migrations (incremental, safe):**
   ```bash
   php artisan migrate
   ```

6. **Verify:**
   ```bash
   php artisan migrate:status
   ```

7. **Restart queue workers (if needed):**
   ```bash
   php artisan queue:restart
   ```

---

## Migration Maintenance

### Regular Backups
```bash
# Weekly backup script
0 2 * * 0 mysqldump -u root -p ecommerce_db > /backups/ecommerce_$(date +\%Y\%m\%d).sql
```

### Monitor Database Size
```bash
php artisan tinker
>>> \DB::select("SELECT table_name, ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb FROM information_schema.TABLES WHERE table_schema = 'ecommerce_db' ORDER BY size_mb DESC;");
```

### Optimize Tables
```bash
php artisan tinker
>>> \DB::statement('OPTIMIZE TABLE products, orders, order_items');
```

---

## Complete Database Setup from Scratch

**Total time: 2-3 minutes**

```bash
# 1. Create database
mysql -u root -p -e "CREATE DATABASE ecommerce_db;"

# 2. Update .env
echo "DB_DATABASE=ecommerce_db" >> .env

# 3. Run migrations with seed
php artisan migrate:fresh --seed

# 4. Start server
php artisan serve

# 5. Test API
curl http://127.0.0.1:8000/api/products
```

✅ **Complete e-commerce database ready!**

