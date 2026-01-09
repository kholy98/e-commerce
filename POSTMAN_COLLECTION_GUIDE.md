# 🚀 E-commerce API Postman Collection - Complete Flow Testing

This file contains comprehensive Postman-ready examples for testing all three e-commerce scenarios:
1. Guest Checkout (No Account)
2. Guest → Register During Checkout  
3. Authenticated User Checkout

## 📋 Environment Setup for Postman

### Environment Variables
```json
{
  "name": "E-commerce API",
  "values": [
    {
      "key": "base_url",
      "value": "http://localhost:8000/api",
      "type": "default",
      "enabled": true
    },
    {
      "key": "auth_token", 
      "value": "",
      "type": "secret",
      "enabled": true
    },
    {
      "key": "guest_email",
      "value": "guest@example.com",
      "type": "default", 
      "enabled": true
    },
    {
      "key": "user_email",
      "value": "test@example.com",
      "type": "default",
      "enabled": true
    },
    {
      "key": "product_id_1",
      "value": "1",
      "type": "default",
      "enabled": true
    },
    {
      "key": "product_id_3", 
      "value": "3",
      "type": "default",
      "enabled": true
    }
  ]
}
```

### Global Headers (for Authenticated Requests)
```json
{
  "Authorization": "Bearer {{auth_token}}",
  "Content-Type": "application/json"
}
```

---

## 🏪 Scenario 1: Guest Checkout (Complete Flow)

### Testing Steps:
1. **No authentication headers** - Remove Authorization header completely
2. **Test session persistence** - Ensure cookies are enabled in Postman
3. **Complete full checkout** - From cart to order creation

### **Step 1: Browse Products**
```bash
Method: GET
URL: {{base_url}}/products
Headers: Content-Type: application/json
Body: none

Expected Response:
{
  "success": true,
  "data": [...]
}
```

### **Step 2: Get Specific Product**
```bash
Method: GET  
URL: {{base_url}}/products/{{product_id_1}}
Headers: Content-Type: application/json
Body: none
```

### **Step 3: Add First Item to Cart (Guest)**
```bash
Method: POST
URL: {{base_url}}/cart/add
Headers: Content-Type: application/json
Body (raw, JSON):
{
  "product_id": {{product_id_1}},
  "quantity": 2
}

Tests Tab:
var jsonData = pm.response.json();
pm.test("Item added successfully", function () {
    pm.expect(jsonData.success).to.be.true;
});
pm.test("Cart summary returned", function () {
    pm.expect(jsonData.cart_summary).to.exist;
});
```

### **Step 4: Add Second Item to Cart (Guest)**
```bash
Method: POST
URL: {{base_url}}/cart/add  
Headers: Content-Type: application/json
Body:
{
  "product_id": {{product_id_3}},
  "quantity": 1
}
```

### **Step 5: View Cart (Guest)**
```bash
Method: GET
URL: {{base_url}}/cart
Headers: Content-Type: application/json
Body: none

Expected Response:
{
  "success": true,
  "data": {
    "items": [...],
    "total": 295.98,
    "item_count": 3,
    "is_guest": true  // 🎯 KEY INDICATOR
  }
}

Tests Tab:
var jsonData = pm.response.json();
pm.test("Guest mode detected", function () {
    pm.expect(jsonData.data.is_guest).to.be.true;
});
pm.test("Cart has items", function () {
    pm.expect(jsonData.data.item_count).to.be.above(0);
});
```

### **Step 6: Get Cart Summary (Guest)**
```bash
Method: GET
URL: {{base_url}}/cart/summary
Headers: Content-Type: application/json
Body: none
```

### **Step 7: Initiate Guest Checkout**
```bash
Method: POST
URL: {{base_url}}/checkout/initiate
Headers: Content-Type: application/json
Body:
{
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
    "email": "{{guest_email}}",
    "phone": "+201234567890",
    "street": "123 Guest Street",
    "city": "Cairo",
    "zip_code": "12345", 
    "country": "Egypt"
  },
  "notes": "Guest checkout test"
}

Expected Response:
{
  "success": true,
  "message": "Checkout initiated successfully",
  "data": {
    "payment_key": "pay_123456",
    "iframe_url": "https://accept.paymob.com/api/acceptance/iframes/123456?payment_token=pay_123456",
    "temp_order_id": "TEMP-123456789",
    "tracking_number": "BOSTA123456789"
  }
}
```

### **Step 8: Simulate Payment Success**
```bash
Method: POST
URL: {{base_url}}/payment/webhook
Headers: Content-Type: application/json
Body:
{
  "obj": {
    "id": "txn_guest_payment_123456",
    "success": true,
    "order": {
      "id": "TEMP-123456789"
    },
    "amount_cents": 29598
  }
}
```

---

## 🔄 Scenario 2: Guest → Register During Checkout

### Testing Steps:
1. **Build guest cart** first (steps 1-5 from above)
2. **Register account** during/after cart
3. **Verify cart migration** preserved items
4. **Complete checkout** as authenticated user

### **Step 1: Add Items to Cart (Guest)**
*Use steps 3-4 from Guest Flow above*

### **Step 2: Register New User**
```bash
Method: POST
URL: {{base_url}}/register
Headers: Content-Type: application/json
Body:
{
  "name": "John Doe",
  "email": "{{user_email}}",
  "password": "password123", 
  "password_confirmation": "password123"
}

Expected Response:
{
  "user": {
    "id": 123,
    "name": "John Doe",
    "email": "test@example.com"
  },
  "token": "1|abc123def456..."  // 🎯 SAVE THIS TO AUTH_TOKEN
}

Tests Tab:
var jsonData = pm.response.json();
pm.test("User registered successfully", function () {
    pm.expect(jsonData.user).to.exist;
});
pm.test("Token received", function () {
    pm.expect(jsonData.token).to.exist;
});
pm.environment.set("auth_token", jsonData.token);  // Auto-set for next requests
```

### **Step 3: Verify Cart Migration**
```bash
Method: GET
URL: {{base_url}}/cart
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json
Body: none

Expected Response:
{
  "success": true,
  "data": {
    "items": [...],  // Same items from guest session
    "total": 295.98,
    "item_count": 3,
    "is_guest": false  // 🎯 MIGRATION SUCCESSFUL
  }
}

Tests Tab:
var jsonData = pm.response.json();
pm.test("Cart migrated to user", function () {
    pm.expect(jsonData.data.is_guest).to.be.false;
});
pm.test("Items preserved", function () {
    pm.expect(jsonData.data.item_count).to.equal(3);
});
```

### **Step 4: Complete Checkout as User**
```bash
Method: POST
URL: {{base_url}}/checkout/initiate
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json
Body:
{
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
    "email": "{{user_email}}",
    "phone": "+201987654321", 
    "street": "456 User Avenue",
    "city": "Alexandria",
    "zip_code": "54321",
    "country": "Egypt"
  },
  "notes": "Converted user checkout test"
}
```

---

## 👤 Scenario 3: Authenticated User Checkout

### Testing Steps:
1. **Login first** to get auth token
2. **Add items** to database cart
3. **Complete checkout** with saved info

### **Step 1: Login**
```bash
Method: POST
URL: {{base_url}}/login
Headers: Content-Type: application/json
Body:
{
  "email": "{{user_email}}",
  "password": "password123"
}

Expected Response:
{
  "user": {
    "id": 123,
    "name": "Test User", 
    "email": "test@example.com"
  },
  "token": "1|abc123def456..."
}

Tests Tab:
var jsonData = pm.response.json();
pm.test("Login successful", function () {
    pm.expect(jsonData.user).to.exist;
});
pm.environment.set("auth_token", jsonData.token);  // Save token
```

### **Step 2: Add Item to Cart (Authenticated)**
```bash
Method: POST
URL: {{base_url}}/cart/add
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json
Body:
{
  "product_id": {{product_id_1}},
  "quantity": 1
}

Expected Response:
{
  "success": true,
  "message": "Item added to cart",
  "cart_summary": {
    "subtotal": 129.99,
    "total": 142.99
  }
}
```

### **Step 3: View Cart (User)**
```bash
Method: GET
URL: {{base_url}}/cart
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json
Body: none

Expected Response:
{
  "success": true,
  "data": {
    "items": [...],
    "total": 142.99,
    "item_count": 1,
    "is_guest": false  // 🎯 USER MODE
  }
}

Tests Tab:
var jsonData = pm.response.json();
pm.test("User mode detected", function () {
    pm.expect(jsonData.data.is_guest).to.be.false;
});
```

### **Step 4: Get Cart Count**
```bash
Method: GET
URL: {{base_url}}/cart/count
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json

Expected Response:
{
  "success": true,
  "data": {
    "item_count": 1,
    "is_empty": false,
    "is_guest": false
  }
}
```

### **Step 5: User Checkout**
```bash
Method: POST
URL: {{base_url}}/checkout/initiate
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json
Body:
{
  "shipping_address": {
    "street": "789 Regular Customer St",
    "city": "Cairo",
    "zip_code": "98765",
    "country": "Egypt",
    "building_number": "789",
    "zone": "Heliopolis"
  },
  "billing_address": {
    "first_name": "Test",
    "last_name": "User",
    "email": "{{user_email}}",
    "phone": "+201111222333"
  },
  "notes": "Regular customer order"
}
```

### **Step 6: View Order History**
```bash
Method: GET
URL: {{base_url}}/orders
Headers: 
  Authorization: Bearer {{auth_token}}
  Content-Type: application/json

Expected Response:
{
  "success": true,
  "data": [
    {
      "id": 5,
      "order_number": "ORD-2026-005",
      "status": "processing",
      "payment_status": "paid",
      "total_amount": 142.99,
      "created_at": "2026-01-08T14:30:00Z"
    }
  ]
}
```

---

## 🛠️ Troubleshooting & Debug Tests

### **Test Session Persistence**
```bash
Request 1: POST /cart/add (add item)
Request 2: GET /cart (check if item persists)

Debug Script:
var jsonData = pm.response.json();
console.log("Cart items:", JSON.stringify(jsonData.data.items, null, 2));
console.log("Is guest:", jsonData.data.is_guest);
```

### **Test Cart Migration**
```bash
# 1. Add item as guest (no auth)
# 2. Register (get token)
# 3. Check cart with auth token

Migration Success Indicators:
- is_guest changes from true → false
- item_count stays same
- Items array contains same products
```

### **Common Error Scenarios**

#### **Empty Cart Error**
```bash
POST /checkout/initiate with empty cart
Expected: 422 "Cart is empty"
```

#### **Invalid Auth Token**
```bash
GET /cart with invalid token
Expected: 401 "Unauthenticated"
```

#### **Product Not Found**
```bash
POST /cart/add with invalid product_id
Expected: 422 "The selected product id is invalid"
```

---

## 📱 Postman Import Instructions

### **Import Steps:**
1. Open Postman
2. Click "Import" 
3. Create "New Collection"
4. Copy requests manually from above (or use the JSON at the end)
5. Set environment variables in "Environment" tab
6. Run requests in sequence

---

## 🎯 Success Criteria

### **Guest Flow Success:**
- ✅ Items persist between cart requests  
- ✅ `is_guest: true` in cart responses
- ✅ Checkout initiates without auth
- ✅ Order created with `user_id: null`

### **Registration Flow Success:**
- ✅ Guest cart items preserved after registration
- ✅ `is_guest` changes from `true` to `false`
- ✅ Auth token works for protected routes
- ✅ Order created with actual `user_id`

### **Authenticated Flow Success:**
- ✅ Login returns valid token
- ✅ Cart operations work with auth header
- ✅ `is_guest: false` in all responses
- ✅ Order history accessible

---

## 🧪 Quick Test Commands (for immediate testing)

### **Test Session is Working:**
```bash
# 1. Add item to cart (no auth)
curl -X POST http://localhost:8000/api/cart/add \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1, "quantity": 1}'

# 2. Check cart (no auth)  
curl -X GET http://localhost:8000/api/cart \
  -H "Content-Type: application/json"

# Should show: is_guest: true, item_count: 1
```

### **Test Cart Migration:**
```bash
# 3. Register (with existing session)
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name": "Test", "email": "test2@example.com", "password": "password123", "password_confirmation": "password123"}'

# 4. Check cart with returned token
TOKEN="RETURNED_TOKEN_HERE"
curl -X GET http://localhost:8000/api/cart \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json"

# Should show: is_guest: false, item_count: 1 (migrated!)
```

---

## 🔧 Postman Configuration Tips

### **Cookie Settings:**
1. Settings → General → Cookies → Enable
2. Turn OFF "Disable cookies" in each request
3. Use same Postman instance for all cart requests

### **Environment Setup:**
1. Click "Environment" tab
2. Add all variables from Environment Variables section
3. Click "Save" 
4. Select environment from dropdown

### **Testing Order:**
1. Run "Guest Flow" requests in order
2. Test "Guest → Register" scenario 
3. Test "Authenticated User" flow
4. Verify `is_guest` field changes correctly

---

## 🐛 Debug Tips

### **If Cart Shows Empty:**
1. **Check session middleware** - Ensure `StartSession` is in API middleware (✅ FIXED)
2. **Enable cookies in Postman** - Settings → General → Cookies
3. **Same session** - Use same Postman tab/window
4. **Check env file** - `SESSION_DRIVER=database` should be set

### **If Migration Fails:**
1. **Check user creation** - Verify user was created successfully
2. **Session cleared** - Items may be lost if session expires
3. **Check database** - Verify `carts` table has user's items

### **If Auth Fails:**
1. **Token format** - Must be "Bearer TOKEN"
2. **Token expiration** - Try logging in again
3. **Sanctum configuration** - Check `php artisan sanctum:list`

This comprehensive Postman collection covers all scenarios and provides detailed testing steps for each checkout flow!