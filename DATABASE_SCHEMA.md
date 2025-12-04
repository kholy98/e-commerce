# Database Schema & Relationships

## Complete Entity Relationship Diagram (ERD)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                         E-COMMERCE DATABASE SCHEMA                          │
└─────────────────────────────────────────────────────────────────────────────┘

                              ┌──────────────┐
                              │    USERS     │
                              ├──────────────┤
                              │ id (PK)      │
                              │ name         │
                              │ email (UQ)   │
                              │ password     │
                              │ phone        │◄─────────┐
                              │ address      │          │
                              │ city         │      (1:M)
                              │ zip_code     │          │
                              │ country      │          │
                              │ timestamps   │          │
                              └──────────────┘          │
                                    │                   │
                    ┌───────────────┼───────────────┐   │
                    │               │               │   │
                 (1:M)           (1:M)           (1:M) │
                    │               │               │   │
        ┌───────────────────┐    ┌─────────────────┐   │
        │ CUSTOMER_ADDRESSES│    │  PRODUCT_REVIEWS│   │
        ├───────────────────┤    ├─────────────────┤   │
        │ id                │    │ id              │   │
        │ user_id (FK)      │    │ user_id (FK)    │   │
        │ label             │    │ product_id (FK) │───┼──────┐
        │ name              │    │ rating (1-5)    │   │      │
        │ phone             │    │ title           │   │      │
        │ address           │    │ comment         │   │   (1:M)
        │ city              │    │ is_verified     │   │      │
        │ zip_code          │    │ is_approved     │   │      │
        │ country           │    │ helpful_count   │   │      │
        │ is_default        │    │ timestamps      │   │      │
        │ timestamps        │    └─────────────────┘   │      │
        └───────────────────┘                          │      │
                                                        │      │
                    ┌────────────────────────┐         │      │
                    │ ORDERS                 │         │      │
                    ├────────────────────────┤         │      │
                    │ id (PK)                │         │      │
                    │ order_number (UQ)      │         │      │
                    │ user_id (FK) ◄─────────┼─────────┘      │
                    │ status (ENUM)          │                │
                    │ payment_status (ENUM)  │                │
                    │ subtotal (decimal)     │                │
                    │ tax (decimal)          │                │
                    │ shipping_cost (decimal)│                │
                    │ total_amount (decimal) │                │
                    │ shipping_address (JSON)│                │
                    │ notes                  │                │
                    │ shipped_at             │                │
                    │ delivered_at           │                │
                    │ cancelled_at           │                │
                    │ timestamps             │                │
                    └────────────────────────┘                │
                            │                                 │
                         (1:M)                                │
                            │                          ┌──────────────────┐
                    ┌──────────────────┐               │   PRODUCTS       │
                    │  ORDER_ITEMS     │               ├──────────────────┤
                    ├──────────────────┤               │ id (PK)          │
                    │ id (PK)          │               │ name             │
                    │ order_id (FK) ◄──┼───────────────│ description      │
                    │ product_id (FK)──┼──────────────►│ sku (UQ)         │
                    │ quantity         │               │ price (decimal)  │
                    │ price (decimal)  │               │ cost (decimal)   │
                    │ subtotal (decimal)               │ stock (integer)  │
                    │ timestamps       │               │ category_id (FK)─┼──────────┐
                    └──────────────────┘               │ is_active        │          │
                                                       │ published_at     │          │
                                                       │ timestamps       │          │
                                                       └──────────────────┘          │
                                                               │                  (1:M)
                                                               │                     │
                                                            (1:M)            ┌──────────────────┐
                                                               │             │   CATEGORIES     │
                                                        ┌──────────────┐     ├──────────────────┤
                                                        │ INVENTORY    │     │ id (PK)          │
                                                        │ _LOGS        │     │ name (UQ)        │
                                                        ├──────────────┤     │ description      │
                                                        │ id (PK)      │     │ slug (UQ)        │
                                                        │ product_id   │     │ is_active        │
                                                        │ qty_before   │     │ sort_order       │
                                                        │ qty_after    │     │ timestamps       │
                                                        │ qty_changed  │     └──────────────────┘
                                                        │ action(ENUM) │
                                                        │ reference_id │
                                                        │ timestamps   │
                                                        └──────────────┘
```

---

## Supporting Tables

### Order Management
```
┌──────────────────────────────────┐
│  ORDER_AUDIT_LOGS                │
├──────────────────────────────────┤
│ id (PK)                          │
│ order_id (FK) ──► ORDERS         │
│ user_id (FK) ──► USERS           │
│ action (created, status_changed) │
│ old_value                        │
│ new_value                        │
│ metadata (JSON)                  │
│ ip_address                       │
│ timestamps                       │
└──────────────────────────────────┘

┌──────────────────────────────────┐
│  PAYMENT_TRANSACTIONS            │
├──────────────────────────────────┤
│ id (PK)                          │
│ order_id (FK) ──► ORDERS         │
│ amount (decimal)                 │
│ status (ENUM)                    │
│ payment_method                   │
│ transaction_id (UQ)              │
│ reference_number                 │
│ gateway_response (JSON)          │
│ failure_reason                   │
│ processed_at                     │
│ timestamps                       │
└──────────────────────────────────┘

┌──────────────────────────────────┐
│  SHIPMENTS                       │
├──────────────────────────────────┤
│ id (PK)                          │
│ order_id (FK) ──► ORDERS         │
│ tracking_number (UQ)             │
│ status (ENUM)                    │
│ carrier                          │
│ carrier_url                      │
│ tracking_history (JSON)          │
│ shipping_cost                    │
│ shipped_at                       │
│ delivered_at                     │
│ expected_delivery_at             │
│ timestamps                       │
└──────────────────────────────────┘
```

### User Features
```
┌──────────────────────────────────┐
│  WISHLIST                        │
├──────────────────────────────────┤
│ id (PK)                          │
│ user_id (FK) ──► USERS           │
│ product_id (FK) ──► PRODUCTS     │
│ timestamps                       │
│ UNIQUE(user_id, product_id)      │
└──────────────────────────────────┘

┌──────────────────────────────────┐
│  DISCOUNT_CODES                  │
├──────────────────────────────────┤
│ id (PK)                          │
│ code (UQ)                        │
│ discount_type (ENUM)             │
│ discount_value (decimal)         │
│ usage_limit                      │
│ usage_count                      │
│ is_active                        │
│ starts_at                        │
│ ends_at                          │
│ timestamps                       │
└──────────────────────────────────┘
```

---

## Column Specifications

### Data Types Used
- **id**: `bigIncrements` - Auto-incrementing big integer (unsigned)
- **String**: `string(255)` - Default text field
- **Text**: `text` - Long text fields (descriptions)
- **Integer**: `integer` - Whole numbers
- **Decimal**: `decimal(precision, scale)` - Money fields
- **Boolean**: `boolean` - true/false
- **JSON**: `json` - Structured data
- **Enum**: `enum(['value1', 'value2'])` - Limited set of values
- **Timestamp**: `timestamp` - Date/time with timezone
- **Foreign Key**: `foreignId` - References another table's ID

### Precision for Money Fields
```
decimal(10, 2) = Up to $9,999,999.99
decimal(12, 2) = Up to $999,999,999.99
decimal(8, 2)  = Up to $999,999.99
```

---

## Constraints & Indexes

### Primary Keys (PK)
Every table has `id` as primary key for unique identification.

### Foreign Keys (FK)
```
users ──→ FOREIGN KEY REFERENCES users(id)
products ──→ FOREIGN KEY REFERENCES categories(id)
order_items ──→ FOREIGN KEY REFERENCES orders(id)
order_items ──→ FOREIGN KEY REFERENCES products(id)
orders ──→ FOREIGN KEY REFERENCES users(id)
(etc.)
```

### Unique Constraints (UQ)
```
users.email
categories.name, categories.slug
products.sku
orders.order_number
payment_transactions.transaction_id
wishlist: (user_id, product_id)
product_reviews: (product_id, user_id)
shipments.tracking_number
discount_codes.code
```

### Indexes for Query Performance
```
-- User lookups
users: email, id

-- Order filtering & sorting
orders: user_id, status, payment_status, created_at, order_number

-- Product searches
products: category_id, is_active, sku

-- Inventory tracking
inventory_logs: product_id, action, created_at

-- Report generation
order_audit_logs: order_id, action, created_at
payment_transactions: order_id, status, created_at
shipments: order_id, status, shipped_at

-- User features
wishlist: user_id, product_id
product_reviews: product_id, user_id, is_approved, created_at
```

---

## Cascade Delete Behavior

When a parent record is deleted, child records are automatically deleted:

```
users → deleted
  ├─ orders → deleted
  │   ├─ order_items → deleted
  │   ├─ order_audit_logs → deleted
  │   ├─ payment_transactions → deleted
  │   └─ shipments → deleted
  ├─ customer_addresses → deleted
  ├─ product_reviews → deleted
  └─ wishlist → deleted

categories → deleted
  └─ products → deleted
      ├─ order_items → deleted
      ├─ inventory_logs → deleted
      ├─ product_reviews → deleted
      └─ wishlist → deleted

products → deleted
  ├─ order_items → deleted
  ├─ inventory_logs → deleted
  ├─ product_reviews → deleted
  └─ wishlist → deleted

orders → deleted
  ├─ order_items → deleted
  ├─ order_audit_logs → deleted
  ├─ payment_transactions → deleted
  └─ shipments → deleted
```

---

## Migration Timeline

| Timestamp | File | Table | Records |
|---|---|---|---|
| `0001_01_01_000000` | create_users_table | users | Framework users |
| `0001_01_01_000001` | create_cache_table | cache | Framework caching |
| `0001_01_01_000002` | create_jobs_table | jobs | Framework queue jobs |
| `2025_12_03_152833` | create_personal_access_tokens_table | personal_access_tokens | API tokens |
| `2025_12_03_153235` | create_permission_tables | roles, permissions | Authorization |
| `2025_12_03_153418` | create_media_table | media | File uploads |
| `2025_12_03_153758` | create_categories_table | categories | 5 sample categories |
| `2025_12_03_153806` | create_products_table | products | 7 sample products |
| `2025_12_03_153816` | create_order_items_table | order_items | Line items |
| `2025_12_03_153821` | create_orders_table | orders | Customer orders |
| `2025_12_04_000001` | create_order_audit_logs_table | order_audit_logs | Change tracking |
| `2025_12_04_000002` | create_product_reviews_table | product_reviews | Reviews |
| `2025_12_04_000003` | create_inventory_logs_table | inventory_logs | Stock history |
| `2025_12_04_000004` | create_payment_transactions_table | payment_transactions | Payment records |
| `2025_12_04_000005` | create_wishlist_table | wishlist | User favorites |
| `2025_12_04_000006` | create_shipments_table | shipments | Shipping |
| `2025_12_04_000007` | create_discount_codes_table | discount_codes | Promos |
| `2025_12_04_000008` | create_customer_addresses_table | customer_addresses | Multiple addresses |

---

## Business Logic Constraints

### Order Status Flow
```
START: pending
   ↓
   ├─→ processing
   │      ↓
   │   shipped
   │      ↓
   │   delivered ✓ (END)
   │
   └─→ cancelled (Can cancel from pending/processing only)
```

### Order Pricing Formula
```
item_subtotal = quantity × price_at_purchase
order_subtotal = SUM(order_items.subtotal)
order_tax = order_subtotal × 0.10 (10% tax rate)
shipping_cost = 
  CASE
    WHEN order_subtotal > 100 THEN 0     (Free shipping)
    ELSE 10                               (Flat $10 fee)
  END
order_total = subtotal + tax + shipping_cost
```

### Payment Status Dependency
```
Order Status: pending  → Payment: pending (can charge)
Order Status: pending  → Payment: failed  (retry or cancel)
Order Status: shipped  → Payment: paid    (locked)
Order Status: cancelled → Payment: refunded (refund issued)
```

### Stock Adjustment Rules
```
CREATE order
  → FOR EACH order_item
    → product.stock -= quantity
    → CREATE inventory_log (order_created)

CANCEL order
  → FOR EACH order_item
    → product.stock += quantity
    → CREATE inventory_log (order_cancelled)
    → payment_status = refunded
```

---

## Sample Data Relationships

### Example Order Flow
```
USER: john@example.com
  ├─ ADDRESS: 123 Main St, New York, NY 10001
  └─ ORDER: ORD-20250104120530-A1B2C3
      ├─ STATUS: pending
      ├─ PAYMENT_STATUS: pending
      ├─ ITEMS:
      │   ├─ Item 1: Laptop (SKU: LAPTOP001) × 1 @ $999.99 = $999.99
      │   ├─ Item 2: Mouse (SKU: MOUSE001) × 2 @ $29.99 = $59.98
      │   └─ Subtotal: $1,059.97
      ├─ TAX: $105.99 (10%)
      ├─ SHIPPING: $0 (Free, > $100)
      ├─ TOTAL: $1,165.96
      └─ AUDIT LOG:
          ├─ created by system (2025-01-04 12:05:30)
          ├─ status changed: pending → processing (2025-01-04 12:10:00)
          ├─ status changed: processing → shipped (2025-01-04 13:00:00)
          └─ payment: pending → paid (2025-01-04 13:15:00)
```

### Inventory Tracking Example
```
PRODUCT: Laptop (SKU: LAPTOP001)
Initial Stock: 50 units

Event 1: Order ORD-001 created (-1 unit)
  stock: 50 → 49
  log: order_created, reference: order_id=123

Event 2: Order ORD-001 cancelled (+1 unit)
  stock: 49 → 50
  log: order_cancelled, reference: order_id=123

Event 3: Manual adjustment (+10 units)
  stock: 50 → 60
  log: manual_update, note="Received shipment"

Current Stock: 60 units
```

