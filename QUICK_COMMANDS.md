# Quick Reference: Artisan Commands for E-Commerce API

## Database & Migration Commands

### Fresh Migration with Seeding (RECOMMENDED FOR FIRST TIME)
```bash
php artisan migrate:fresh --seed
```
This will:
- Drop all tables
- Recreate all tables
- Seed with sample data (categories, products, users)

### Individual Commands
```bash
# Run all migrations
php artisan migrate

# Roll back last migration
php artisan migrate:rollback

# Roll back all migrations
php artisan migrate:reset

# Run migrations and seed in one command
php artisan migrate:refresh --seed

# Only run seeders without migration
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

---

## Generate Commands (Already Created - For Reference)

```bash
# Create Model with Controller and Migration
php artisan make:model Product -mcr

# Create individual components
php artisan make:controller ProductController
php artisan make:model Product
php artisan make:migration create_products_table
php artisan make:seeder CategorySeeder
php artisan make:policy OrderPolicy --model=Order
php artisan make:request StoreOrderRequest
php artisan make:resource OrderResource
php artisan make:event OrderCreated
php artisan make:service OrderService
```

---

## Server & Development Commands

```bash
# Start Laravel development server
php artisan serve
# Then visit: http://localhost:8000/api/products

# Start with specific port
php artisan serve --port=3000

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Clear everything
php artisan optimize:clear
```

---

## Useful Tinker Commands

```bash
# Open interactive shell
php artisan tinker

# Inside tinker:

# Create a product
App\Models\Product::create([
  'name' => 'Test Product',
  'description' => 'Test',
  'price' => 99.99,
  'stock' => 100,
  'sku' => 'TEST-001',
  'category_id' => 1,
  'is_active' => true
]);

# Get all products
App\Models\Product::all();

# Get product by ID
App\Models\Product::find(1);

# Create an order
$order = App\Models\Order::create([
  'order_number' => 'ORD-TEST-001',
  'user_id' => 1,
  'status' => 'pending',
  'payment_status' => 'pending',
  'total_amount' => 150.00
]);

# List all orders
App\Models\Order::all();

# Exit tinker
exit
```

---

## Testing the API

### Using Postman / Insomnia:

1. **Base URL**: `http://localhost:8000/api`

2. **Get All Products**
   - Method: GET
   - URL: `/products`

3. **Get Product by ID**
   - Method: GET
   - URL: `/products/1`

4. **Get Categories**
   - Method: GET
   - URL: `/products/categories`

5. **Add to Cart**
   - Method: POST
   - URL: `/cart/add`
   - Body (JSON):
   ```json
   {
     "product_id": 1,
     "quantity": 2
   }
   ```

6. **Get Cart**
   - Method: GET
   - URL: `/cart`

7. **Create Order** (Requires Auth)
   - Method: POST
   - URL: `/orders`
   - Headers: Add `Authorization: Bearer {token}`
   - Body (JSON):
   ```json
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
     "notes": "Optional notes"
   }
   ```

8. **Get User Orders** (Requires Auth)
   - Method: GET
   - URL: `/orders`

9. **Get Specific Order**
   - Method: GET
   - URL: `/orders/1`

10. **Cancel Order**
    - Method: POST
    - URL: `/orders/1/cancel`

11. **Update Order Status** (Admin)
    - Method: PATCH
    - URL: `/admin/orders/1/status`
    - Body (JSON):
    ```json
    {
      "status": "shipped",
      "payment_status": "paid"
    }
    ```

---

## Debugging Commands

```bash
# Check route list
php artisan route:list

# List all routes with details
php artisan route:list --verbose

# Check specific route
php artisan route:list | grep orders

# Show Laravel version
php artisan --version

# Check PHP version
php --version

# Run tests
php artisan test

# Run specific test
php artisan test tests/Feature/OrderTest.php
```

---

## Environment Setup

```bash
# Generate app key
php artisan key:generate

# Setup .env file
# Make sure these are set:
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_api
DB_USERNAME=root
DB_PASSWORD=

# Create database (via MySQL)
CREATE DATABASE ecommerce_api;
```

---

## File Structure Reference

```
ecommerce-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php    ✓ Created
│   │   │   ├── OrderController.php      ✓ Created
│   │   │   └── CartController.php       ✓ Created
│   │   ├── Requests/
│   │   │   └── StoreOrderRequest.php    ✓ Created
│   │   └── Resources/
│   │       ├── OrderResource.php        ✓ Created
│   │       ├── OrderItemResource.php    ✓ Created
│   │       ├── ProductResource.php      ✓ Created
│   │       └── CategoryResource.php     ✓ Created
│   ├── Models/
│   │   ├── User.php                     ✓ Updated
│   │   ├── Product.php                  ✓ Updated
│   │   ├── Order.php                    ✓ Updated
│   │   ├── OrderItem.php                ✓ Updated
│   │   └── Category.php                 ✓ Updated
│   ├── Services/
│   │   ├── OrderService.php             ✓ Created
│   │   └── CartService.php              ✓ Created
│   ├── Events/
│   │   ├── OrderCreated.php             ✓ Created
│   │   ├── OrderShipped.php             ✓ Created
│   │   └── OrderCancelled.php           ✓ Created
│   └── Policies/
│       └── OrderPolicy.php              ✓ Created
│
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php  ✓ (Should exist)
│   │   ├── create_products_table.php    ✓ (Should exist)
│   │   ├── create_orders_table.php      ✓ (Should exist)
│   │   └── create_order_items_table.php ✓ (Should exist)
│   └── seeders/
│       ├── CategorySeeder.php           ✓ Created
│       ├── ProductSeeder.php            ✓ Created
│       └── DatabaseSeeder.php           ✓ Updated
│
├── routes/
│   └── api.php                          ✓ Updated
│
└── ECOMMERCE_IMPLEMENTATION.md          ✓ Full documentation
```

---

## Troubleshooting

### Issue: Database not found
```bash
# Create the database
mysql -u root -p -e "CREATE DATABASE ecommerce_api;"

# Then run
php artisan migrate:fresh --seed
```

### Issue: Routes not working
```bash
# Clear route cache
php artisan route:clear

# Rebuild routes
php artisan route:cache
```

### Issue: Migrations failed
```bash
# Check migration status
php artisan migrate:status

# Reset and try again
php artisan migrate:reset
php artisan migrate
```

### Issue: Classes not found
```bash
# Rebuild composer autoloader
composer dump-autoload

# Then restart server
php artisan serve
```

---

## Production Deployment Checklist

```bash
# Before deploying:

# 1. Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 2. Run migrations
php artisan migrate --force

# 3. Optimize
php artisan optimize

# 4. Setup storage
php artisan storage:link

# 5. Setup queues (if used)
php artisan queue:work
```

---

## Key Endpoints Summary

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| GET | `/products` | ❌ | List products |
| GET | `/products/{id}` | ❌ | Get product |
| GET | `/products/categories` | ❌ | List categories |
| GET | `/cart` | ✅ | View cart |
| POST | `/cart/add` | ✅ | Add to cart |
| GET | `/cart/summary` | ✅ | Cart totals |
| POST | `/orders` | ✅ | Create order |
| GET | `/orders` | ✅ | User orders |
| GET | `/orders/{id}` | ✅ | Order details |
| POST | `/orders/{id}/cancel` | ✅ | Cancel order |
| PATCH | `/admin/orders/{id}/status` | ✅ | Update status (Admin) |
| GET | `/admin/orders/statistics` | ✅ | Order stats (Admin) |

---

## Useful Composer Commands

```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Add new package
composer require package-name

# Remove package
composer remove package-name

# Dump autoloader
composer dump-autoload

# Run composer scripts
composer run-script post-autoload-dump
```
