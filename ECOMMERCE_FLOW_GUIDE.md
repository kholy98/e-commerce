# E-commerce Flow Guide: Guest vs User Checkout

This guide explains the complete e-commerce flow for different user scenarios with step-by-step examples.

## 🎯 Scenarios Covered

1. **Guest Checkout** - Complete purchase without account
2. **Guest → Register During Checkout** - Start as guest, create account mid-flow  
3. **Authenticated User** - Logged-in user making purchase

---

## 🏪 Scenario 1: Guest Checkout (No Registration)

### Flow Overview
```
Guest browses → Cart in session → Checkout → Shipment → Payment → Order (Guest) → Email confirmation
```

### Step-by-Step Process

#### 1. Browse Products (No Authentication)
```bash
# Get all products
curl -X GET http://localhost:8000/api/products

# Get specific product
curl -X GET http://localhost:8000/api/products/1
```

#### 2. Add Items to Cart (Session-Based)
```bash
# Add first item
curl -X POST http://localhost:8000/api/cart/add \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "quantity": 2
  }'

# Response
{
  "success": true,
  "message": "Item added to cart",
  "cart_summary": {
    "subtotal": 259.98,
    "tax": 26.00,
    "shipping": 10.00,
    "total": 295.98,
    "item_count": 2
  }
}

# Add second item  
curl -X POST http://localhost:8000/api/cart/add \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 3,
    "quantity": 1
  }'
```

#### 3. View Cart (Guest Session)
```bash
curl -X GET http://localhost:8000/api/cart

# Response shows is_guest: true
{
  "success": true,
  "data": {
    "items": [...],
    "total": 295.98,
    "item_count": 3,
    "is_guest": true
  }
}
```

#### 4. Initiate Checkout (Guest)
```bash
curl -X POST http://localhost:8000/api/checkout/initiate \
  -H "Content-Type: application/json" \
  -d '{
    "shipping_address": {
      "street": "123 Guest Street",
      "city": "Cairo",
      "zip_code": "12345", 
      "country": "Egypt",
      "building_number": "123",
      "floor": "4",
      "apartment": "4B",
      "zone": "Nasr City"
    },
    "billing_address": {
      "first_name": "Guest",
      "last_name": "User",
      "email": "guest@example.com",
      "phone": "+201234567890",
      "street": "123 Guest Street",
      "city": "Cairo", 
      "zip_code": "12345",
      "country": "Egypt"
    },
    "notes": "Guest checkout order"
  }'
```

#### 5. Complete Payment (Guest)
```bash
# System redirects to Paymob iframe URL from response
# Payment processed, webhook triggers order creation

# Final order stored as guest order (user_id = null)
```

#### 6. Order Created (Guest)
```json
{
  "success": true,
  "message": "Order created successfully", 
  "data": {
    "id": 1,
    "order_number": "ORD-2026-001",
    "user_id": null,  // Guest order
    "tracking_number": "BOSTA123456789",
    "status": "processing",
    "payment_status": "paid",
    "shipping_address": {...},
    "billing_address": {...}
  }
}
```

#### 7. Guest Order Management
- Guest receives order confirmation via email
- Can track order using tracking number only
- No order history available without account

---

## 🔄 Scenario 2: Guest → Register During Checkout

### Flow Overview  
```
Guest browses → Cart in session → During checkout, choose register → Create account → Migrate cart → Complete checkout → User order
```

### Step-by-Step Process

#### 1-3. Same as Guest Flow Above
*Follow steps 1-3 from Guest scenario*

#### 4. Register During Checkout Process
```bash
# Guest decides to create account during checkout
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "johndoe@example.com", 
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Key Behind-the-Scenes Action:**
```php
// During registration, system automatically:
SessionCartService->migrateSessionToDatabase();
```

#### 5. Cart Migration Happens Automatically
```bash
# Check cart after registration
curl -X GET http://localhost:8000/api/cart \
  -H "Authorization: Bearer USER_TOKEN_HERE"

# Response shows is_guest: false and items preserved
{
  "success": true,
  "data": {
    "items": [...],  // Same items from guest session
    "total": 295.98,
    "item_count": 3,
    "is_guest": false
  }
}
```

#### 6. Complete Checkout as Authenticated User
```bash
curl -X POST http://localhost:8000/api/checkout/initiate \
  -H "Authorization: Bearer USER_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "shipping_address": {...},
    "billing_address": {...}
  }'
```

#### 7. Order Created (Associated with User)
```json
{
  "success": true,
  "data": {
    "id": 2,
    "order_number": "ORD-2026-002", 
    "user_id": 123,  // Associated with registered user
    "tracking_number": "BOSTA987654321",
    "status": "processing",
    "payment_status": "paid"
  }
}
```

#### 8. User Benefits After Registration
- Order appears in user's order history
- Can view order details via API with authentication
- Can track future orders in account dashboard
- Personal information saved for faster checkout

---

## 👤 Scenario 3: Authenticated User Checkout

### Flow Overview
```
Login → Browse → Cart in database → Checkout → Shipment → Payment → Order (User Account) → Order History
```

### Step-by-Step Process

#### 1. Login First
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "johndoe@example.com",
    "password": "password123"
  }'

# Response
{
  "user": {
    "id": 123,
    "name": "John Doe",
    "email": "johndoe@example.com"
  },
  "token": "1|abc123def456..."
}
```

**Automatic Cart Migration:**
- If user had guest cart items, they're migrated to database
- Existing database cart items are preserved and merged

#### 2. Browse Products (Authenticated)
```bash
# Same endpoints, but can access user-specific features
curl -X GET http://localhost:8000/api/products \
  -H "Authorization: Bearer USER_TOKEN"
```

#### 3. Add Items to Cart (Database Storage)
```bash
curl -X POST http://localhost:8000/api/cart/add \
  -H "Authorization: Bearer USER_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "quantity": 1
  }'
```

**Storage Difference:**
- Guest: Cart stored in PHP session
- User: Cart stored in database `carts` table
- Both use same API endpoints

#### 4. View Cart (User)
```bash
curl -X GET http://localhost:8000/api/cart \
  -H "Authorization: Bearer USER_TOKEN"

# Response shows is_guest: false
{
  "success": true,
  "data": {
    "items": [...],
    "total": 295.98,
    "item_count": 3,
    "is_guest": false
  }
}
```

#### 5. Checkout with Saved Information
```bash
curl -X POST http://localhost:8000/api/checkout/initiate \
  -H "Authorization: Bearer USER_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "shipping_address": {
      "street": "456 User Avenue", 
      "city": "Alexandria",
      "zip_code": "54321",
      "country": "Egypt",
      "building_number": "456",
      "floor": "2",
      "apartment": "2A",
      "zone": "Sidi Gaber"
    },
    "billing_address": {
      "first_name": "John",
      "last_name": "Doe", 
      "email": "johndoe@example.com",
      "phone": "+201987654321",
      "street": "456 User Avenue",
      "city": "Alexandria",
      "zip_code": "54321", 
      "country": "Egypt"
    },
    "notes": "Regular customer order"
  }'
```

#### 6. Order Created and Stored in User History
```json
{
  "success": true,
  "data": {
    "id": 3,
    "order_number": "ORD-2026-003",
    "user_id": 123,  // Linked to authenticated user
    "status": "processing",
    "payment_status": "paid",
    "tracking_number": "BOSTA555666777"
  }
}
```

#### 7. View Order History
```bash
curl -X GET http://localhost:8000/api/orders \
  -H "Authorization: Bearer USER_TOKEN"

# Response shows all user's orders
{
  "success": true,
  "data": [
    {
      "id": 2,
      "order_number": "ORD-2026-002",
      "status": "delivered",
      "total_amount": 295.98,
      "created_at": "2026-01-07T10:00:00Z"
    },
    {
      "id": 3, 
      "order_number": "ORD-2026-003",
      "status": "processing",
      "total_amount": 295.98,
      "created_at": "2026-01-08T12:00:00Z"
    }
  ]
}
```

---

## 🔄 Cart Migration Details

### When Migration Occurs

1. **During Registration:**
   ```php
   // User registers with existing guest cart
   SessionCartService->migrateSessionToDatabase();
   ```

2. **During Login:**
   ```php
   // User logs in with existing guest cart  
   SessionCartService->migrateSessionToDatabase();
   ```

### Migration Logic
```php
// For each item in session cart:
foreach ($sessionCart as $productId => $quantity) {
    $existingCartItem = $user->carts()->where('product_id', $productId)->first();
    
    if ($existingCartItem) {
        // Merge quantities
        $existingCartItem->update(['quantity' => $existingCartItem->quantity + $quantity]);
    } else {
        // Create new cart item
        $user->carts()->create([
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }
}

// Clear session cart
Session::forget('guest_cart');
```

---

## 🎯 Key Differences Summary

| Feature | Guest | Guest→Register | Authenticated User |
|---------|--------|---------------|-------------------|
| **Cart Storage** | Session | Session → Database | Database |
| **Account Creation** | No | During checkout | Before checkout |
| **Order Association** | user_id = null | user_id = user_id | user_id = user_id |
| **Order History** | No access | After registration | Full access |
| **Future Checkout** | Re-enter info | Saved info available | Saved info available |
| **Cart Migration** | N/A | Automatic on register | Automatic on login |

---

## 🛡️ Security & Data Persistence

### Guest Cart Persistence
```php
// Session configuration ensures cart persists across requests
'session' => [
    'driver' => 'file',
    'lifetime' => 120, // 2 hours
    'expire_on_close' => false,
]
```

### User Data Protection
- All authenticated routes use Sanctum tokens
- Cart items validated against stock
- Payment data encrypted via Paymob
- Personal info stored securely

### Error Recovery
- Failed orders restore cart items
- Payment failures don't create orders
- Shipment failures trigger cleanup
- Database transactions ensure consistency

---

## 🧪 Testing Each Scenario

### Test Guest Flow
```bash
# 1. Add items without auth
# 2. Checkout as guest  
# 3. Verify guest order creation
```

### Test Registration Flow
```bash
# 1. Add items as guest
# 2. Register during checkout
# 3. Verify cart migration
# 4. Complete checkout as user
```

### Test Authenticated Flow
```bash
# 1. Login first
# 2. Add items to cart
# 3. Checkout with saved info
# 4. Verify order in history
```

---

## 📱 Frontend Integration Tips

### Detect User State
```javascript
// Check if user is guest or authenticated
const isGuest = !response.data.is_guest;
const cartCount = response.data.item_count;
```

### Handle Registration During Checkout
```javascript
// Offer registration option during guest checkout
if (isGuest && checkoutStep === 'payment') {
    showRegisterOption();
}
```

### Seamless Experience
```javascript
// Migrate cart seamlessly when user logs in/registers
async function handleAuthentication(credentials) {
    const response = await authenticate(credentials);
    if (response.success) {
        await refreshCart(); // Cart will be migrated
    }
}
```

This comprehensive flow ensures a smooth experience regardless of when users choose to create an account, while maintaining data integrity and security throughout the process.