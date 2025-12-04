# Migration Setup & Verification Guide

## ✅ Pre-Migration Checklist

Before running migrations, verify:

- [ ] `.env` file is configured
- [ ] Database exists (create if needed)
- [ ] MySQL/Database server is running
- [ ] Composer dependencies installed (`composer install`)

---

## 🔧 Database Connection Setup

### Verify `.env` File

Open `.env` and check these values:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_api
DB_USERNAME=root
DB_PASSWORD=
```

**If you're using XAMPP:**
- Host: 127.0.0.1 ✅
- Port: 3306 ✅
- Username: root ✅
- Password: (usually empty) ✅

---

## 🗄️ Create Database

### Option 1: Using PHP/Laravel (Easier)
```bash
# This will create database if it doesn't exist
php artisan migrate
```

If migration fails with "database doesn't exist", use Option 2:

### Option 2: Using MySQL Directly

**PowerShell:**
```powershell
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS ecommerce_api;"
```

**MySQL Console:**
```sql
mysql> CREATE DATABASE IF NOT EXISTS ecommerce_api;
mysql> USE ecommerce_api;
mysql> SHOW TABLES;  -- Should be empty
```

---

## 🚀 Running Migrations

### Method 1: Fresh Setup (Recommended First Time)
```bash
php artisan migrate:fresh --seed
```

**What this does:**
1. Drops all existing tables
2. Runs all migration files in order
3. Seeds database with sample data
4. Creates 5 categories
5. Creates 7 products
6. Creates 1 test user

**Time:** ~5 seconds
**Best for:** Starting fresh

---

### Method 2: Just Migrate (Without Seeding)
```bash
php artisan migrate
```

**What this does:**
1. Runs all pending migrations
2. Creates all tables
3. Does NOT load sample data

**Use when:** You want empty database, or have custom data to add

---

### Method 3: Migrate with Seeding (Separate)
```bash
php artisan migrate
php artisan db:seed
```

Same as Method 1 but in two steps

---

## 📋 Expected Migration Order

Migrations run in alphabetical order by timestamp. They should run in this order:

1. **0001_01_01_000000_create_users_table.php**
   - Creates users table
   - Has: id, name, email, password, etc.

2. **0001_01_01_000001_create_cache_table.php**
   - Creates cache table (for caching)

3. **0001_01_01_000002_create_jobs_table.php**
   - Creates jobs table (for queue processing)

4. **2025_12_03_152833_create_personal_access_tokens_table.php**
   - Creates tokens for API authentication (Sanctum)

5. **2025_12_03_153235_create_permission_tables.php**
   - Creates roles and permissions tables

6. **2025_12_03_153418_create_media_table.php**
   - Creates media/file upload table

7. **2025_12_03_153758_create_categories_table.php**
   - ✅ Creates categories table
   - Columns: id, name, description, is_active, timestamps

8. **2025_12_03_153806_create_products_table.php**
   - ✅ Creates products table
   - Columns: id, name, description, price, cost, stock, sku, category_id, is_active, timestamps
   - Foreign key: category_id → categories.id

9. **2025_12_03_153816_create_order_items_table.php**
   - ✅ Creates order_items table
   - Columns: id, order_id, product_id, quantity, unit_price, subtotal, timestamps
   - Foreign keys: order_id → orders.id, product_id → products.id

10. **2025_12_03_153821_create_orders_table.php**
    - ✅ Creates orders table
    - Columns: id, order_number, user_id, status, payment_status, subtotal, tax, shipping_cost, total_amount, shipping_address, notes, timestamps
    - Foreign key: user_id → users.id

---

## ✅ Verify Migration Success

### Check All Tables Created

```bash
# Using PHP Artisan
php artisan migrate:status
```

Should show all migrations as "Ran":
```
Migration Name                                      Batch
─────────────────────────────────────────────────────────
...previous migrations...                            1
2025_12_03_153758_create_categories_table            1
2025_12_03_153806_create_products_table              1
2025_12_03_153816_create_order_items_table           1
2025_12_03_153821_create_orders_table                1
```

### Check Database Directly

```bash
# Using MySQL
mysql -u root -p ecommerce_api
```

Then list tables:
```sql
SHOW TABLES;
```

Should show:
```
cache
cache_locks
categories
failed_jobs
jobs
jobs_batches
media
migrations
model_has_permissions
model_has_roles
orders
order_items
personal_access_tokens
products
role_has_permissions
roles
users
```

### Check Table Columns

```bash
php artisan tinker

# Inside tinker:
Schema::getColumnListing('products')
Schema::getColumnListing('orders')
Schema::getColumnListing('order_items')
```

---

## 🌱 Seeding with Data

### Seed All Data
```bash
php artisan db:seed
```

Seeds all defined seeders.

### Seed Specific Seeder
```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

### Verify Seeded Data

```bash
php artisan tinker

# Inside tinker:
Category::count()              # Should return 5
Product::count()               # Should return 7
User::count()                  # Should return 1
Order::count()                 # Should return 0 (no orders yet)

# See categories
Category::all()

# See products
Product::all()

# See user
User::first()
```

---

## 🔄 Undoing Migrations

### Rollback Last Batch
```bash
php artisan migrate:rollback
```

Undoes last set of migrations (usually 1 if they were run together)

### Rollback All Migrations
```bash
php artisan migrate:reset
```

Undoes ALL migrations, dropping all tables

### Rollback Specific Batch
```bash
php artisan migrate:rollback --step=1
```

Undoes last 1 migration
```bash
php artisan migrate:rollback --step=3
```

Undoes last 3 migrations

---

## 🔄 Refresh Migrations

### Refresh: Reset + Migrate
```bash
php artisan migrate:refresh
```

Equivalent to:
1. Drop all tables
2. Recreate all tables
3. (Does NOT seed data)

### Refresh + Seed
```bash
php artisan migrate:refresh --seed
```

Equivalent to:
1. Drop all tables
2. Recreate all tables
3. Seed with data

**Note:** Use `migrate:fresh --seed` instead (faster, more modern)

---

## 📊 Migration File Anatomy

### Structure of a Migration File

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This is called when you run php artisan migrate
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * This is called when you run php artisan migrate:rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

**Key parts:**
- `up()` - Creates/modifies tables
- `down()` - Reverses changes
- Foreign keys ensure relationships

---

## 🚨 Common Migration Issues

### Issue: "SQLSTATE[HY000]: General error: 1364"
**Cause:** Missing required column in insert

**Fix:** Check if all `NOT NULL` columns have defaults or are fillable in model

### Issue: "Specified key was too long"
**Cause:** String field too long for key

**Fix:** Use `string('field', 191)` instead of `string('field')`

### Issue: "Cannot truncate table"
**Cause:** Foreign key constraints

**Fix:** Disable foreign key checks before truncate:
```sql
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE orders;
TRUNCATE order_items;
SET FOREIGN_KEY_CHECKS = 1;
```

### Issue: "Access denied for user 'root'@'localhost'"
**Cause:** Wrong password in .env

**Fix:** Check DB_PASSWORD in .env file (usually empty for XAMPP)

---

## 🔍 Troubleshooting Checklist

- [ ] MySQL/Database server is running
- [ ] Database name in .env matches created database
- [ ] Database username/password correct in .env
- [ ] All migration files exist in `database/migrations/`
- [ ] No syntax errors in migration files
- [ ] Tables don't already exist
- [ ] Foreign key constraints are valid

---

## 📝 Migration Notes

### Important Columns

**Orders Table Requires:**
```php
$table->id();
$table->string('order_number')->unique();  // ORD-XXXXX
$table->foreignId('user_id');              // Links to users
$table->enum('status', [                    // Order status
    'pending',
    'processing', 
    'shipped',
    'delivered',
    'cancelled'
])->default('pending');
$table->enum('payment_status', [            // Payment status
    'pending',
    'paid',
    'failed',
    'refunded'
])->default('pending');
$table->decimal('total_amount', 10, 2);    // Total price
$table->timestamps();
```

**Products Table Requires:**
```php
$table->id();
$table->string('name');
$table->text('description');
$table->decimal('price', 10, 2);           // Product price
$table->integer('stock')->default(0);      // Quantity
$table->string('sku')->unique();           // Product code
$table->foreignId('category_id');          // Category link
$table->boolean('is_active')->default(1);  // Available?
$table->timestamps();
```

---

## ✨ Best Practices

1. **Always backup before rollback in production**
   ```bash
   mysqldump -u root ecommerce_api > backup.sql
   ```

2. **Test migrations locally first**
   ```bash
   php artisan migrate:fresh
   ```

3. **Keep migrations small and focused**
   - One table per migration
   - One set of related changes per migration

4. **Write reversible migrations**
   - Always implement `down()` method
   - Test rollback: `php artisan migrate:rollback`

5. **Never modify existing migrations in production**
   - Create new migration instead
   - Always deploy with `php artisan migrate`

---

## 📊 Database Health Check

```bash
php artisan tinker
```

Inside tinker:

```php
# Check row counts
DB::table('users')->count()           // Should be > 0
DB::table('categories')->count()      // Should be 5
DB::table('products')->count()        // Should be 7
DB::table('orders')->count()          // Should be 0

# Check foreign keys work
$product = Product::first();
$product->category;                   // Should return category

# Check relationships
$user = User::first();
$user->orders;                        // Should return orders collection
```

---

## 🎯 Next Steps After Migration

1. **Seed data**
   ```bash
   php artisan db:seed
   ```

2. **Start server**
   ```bash
   php artisan serve
   ```

3. **Test API**
   ```
   http://localhost:8000/api/products
   ```

4. **Create orders**
   ```bash
   curl http://localhost:8000/api/orders
   ```

---

**Migration setup complete! Ready to run the API.** 🚀
