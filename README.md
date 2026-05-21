# Al-Ather E-Commerce Platform

A production-ready bilingual (Arabic/English) multi-vendor e-commerce platform for coffee products, built for the Egyptian market. Features full integration with **Paymob** (payments), **Bosta** (logistics), and **WhatsApp** (notifications).

## Tech Stack

- **Backend:** Laravel 12, PHP 8.4
- **Frontend:** React 19, Inertia.js v2, TypeScript, Tailwind CSS v4
- **Admin UI:** Radix UI primitives, Recharts, Lucide React icons
- **Auth:** Laravel Fortify (login, registration, 2FA, email verification, password reset), Sanctum (API tokens)
- **Media:** Spatie Media Library
- **Testing:** Pest v4 + PHPUnit 12
- **API Docs:** Scribe

## Key Features

### Product Management
- Bilingual product names/descriptions (English & Arabic)
- Category assignment with images and sort ordering
- Grind types (Light/Medium/Dark) and weights (125g/250g/500g/1kg)
- Dynamic product details stored as JSON (key-value pairs with bilingual titles)
- Multiple images per product via Spatie Media Library with thumbnail conversion
- Stock tracking with low stock alerts (< 10)
- SKU management, active/inactive toggling, supplier assignment
- Cost tracking alongside selling price

### Multi-Vendor (Supplier) System
- Products assigned to suppliers with their own dashboard
- Supplier sees only orders containing their products
- Suppliers can update order status for their line items

### Shopping Cart
- Dual cart system: **session-based** for guests, **database-backed** for authenticated users
- Seamless cart migration on login/register (guest cart transfers to user account)
- Add, update quantity, remove, and clear operations
- Stock validation during all cart operations
- Full pricing breakdown (subtotal, tax, shipping, total)

### Checkout & Payments
- Guest and authenticated checkout flows
- **Paymob** online payment integration via iframe
- **Cash on Delivery (COD)** support
- Pending checkout with 24-hour expiry (cleaned hourly via scheduler)
- Paymob callback handling (GET redirect + POST webhook)
- Secure webhook signature verification

### Shipping (Bosta Integration)
- Egyptian logistics provider integration
- Zone-based pricing: Cairo, Alexandria, Delta/Canal, Upper Egypt/Red Sea
- Package size categories: small/medium, light bulky, heavy bulky
- Create delivery, track, update, cancel (terminate), and create pickup
- Bosta webhook handling for status updates
- Configurable free shipping threshold and VAT

### Order Management
- Auto-generated order numbers (`ORD-YYYYMMDDHHMMSS-RANDOM`)
- Status workflow: pending → processing → shipped → delivered → cancelled
- Payment statuses: pending, paid, failed, refunded
- Billing/shipping addresses stored as JSON snapshots
- Order cancellation with automatic stock restoration
- Statistics dashboard (counts by status, revenue)
- **Notifications:** Email to customer (OrderCreatedNotification), Email to each supplier with products in the order (OrderCreatedForSupplierNotification), WhatsApp confirmation via Twilio/Meta Business API

### User Addresses
- Full CRUD with bilingual labels
- Default, billing, and shipping address flags
- Bosta-formatted and Paymob-formatted address output

### Wishlist
- Add/remove products, check wishlist status, clear entire list
- Validation prevents inactive or duplicate products

### Authentication & Security
- Fortify-powered: login, registration, password reset, email verification
- Two-factor authentication (2FA) with recovery codes and QR code setup
- Sanctum API token auth for the storefront
- Rate-limited password updates (6 attempts/hour)
- Role system via boolean flags: `is_admin`, `is_supplier`
- Admin and supplier middleware for route protection

### Admin Dashboard (Inertia + React)
- Statistics cards: total users, products, categories, orders, revenue
- Revenue chart (monthly, configurable year)
- Best sellers table
- Donut charts: customer distribution, user types, order statuses
- Low stock products alert
- Full CRUD pages for: Products, Categories, Orders, Users, Team Members, Inquiries, Contact Us, Environment Settings

### Supplier Dashboard
- Supplier-specific stats and product metrics
- Order management filtered to supplier's products
- Order status updates

### CRM - Contact Inquiries
- Public submission form (name, email, phone, company, message)
- Admin management: filter by status, reply to inquiries (sends email)
- Testimonial publishing: replied inquiries can be published/unpublished
- Public API endpoint for published testimonials (sensitive fields excluded)

### Team Members
- CRUD with images, social media links (JSON)
- Public API endpoint

### Dynamic Environment Configuration
- API keys and settings stored in the database (`settings` table)
- Admin UI to manage: Paymob, Bosta, Mail, WhatsApp, Frontend URL settings
- Settings loaded into Laravel config at boot via `AppServiceProvider`
- Debug endpoint to view active config vs stored settings
- No `.env` file editing required for runtime configuration

### Bilingual (Arabic/English) Architecture
- All content models include `_ar` suffix fields for Arabic translations
- API responses structured with `en`/`ar` keys
- Enums provide `label()` and `labelAr()` methods
- Dashboard supports both languages

## Architecture

### Service Layer Pattern
Business logic is encapsulated in dedicated service classes:

| Service | Responsibility |
|---------|---------------|
| `CartService` / `SessionCartService` | Cart operations (session vs database) |
| `OrderService` | Order creation, cancellation, refund, statistics |
| `PaymobPaymentService` | Paymob API integration (implements `PaymentGatewayInterface`) |
| `BostaApiService` | Bosta shipping API operations |
| `BostaPricingService` | Shipping cost calculation by zone |
| `WhatsAppService` | WhatsApp notifications (Twilio + Meta Business API) |
| `ContactInquiryService` | Inquiry management workflow |
| `EnvService` | Database-driven `.env` configuration |

### Payment Gateway Interface
- `PaymentGatewayInterface` contract with `sendPayment()` and `callBack()` methods
- `PaymobPaymentService` implements the interface, bound via `PaymentServiceProvider`
- Easily swappable for different payment gateways

### Database Schema (38 migrations)
Core tables: `users`, `categories`, `products`, `orders`, `order_items`, `carts`, `wishlist`, `customer_addresses`, `contact_inquiries`, `contact_us`, `team_members`, `pending_checkouts`, `settings`, `shipments`, `media`, `payment_transactions`, `order_audit_logs`, `inventory_logs`, `product_reviews`, `discount_codes`

### Session Token Middleware
Workaround for Safari ITP (Intelligent Tracking Prevention) — reads/writes `X-Session-Token` header to maintain session state for guest carts across API requests.

## API Structure

**Public routes** (no auth): Products, categories, cart, checkout, contact info, published testimonials

**Authenticated routes** (Sanctum): User profile, orders, wishlist, addresses

**Admin routes** (web + admin middleware): Full CRUD for all entities, dashboard stats, env settings

**Supplier routes** (web + supplier middleware): Dashboard, filtered orders, status updates

**Webhooks**: Paymob payment callbacks, Bosta shipment updates

## Testing

- 5+ feature test files covering: Cart, Wishlist, Customer Addresses, Contact Inquiry Publishing
- Uses `RefreshDatabase` for clean state
- Mix of PHPUnit and Pest syntax
- Factory usage for all major models
- Sanctum authentication in API tests

## Console Commands

- `pending-checkouts:cleanup` — removes expired pending checkouts (runs hourly via scheduler)
- `wayfinder:generate` — regenerates TypeScript route definitions after route changes

## Getting Started

```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate --seed

# Build frontend
npm run build

# Start development server
php artisan serve
```

**Note:** Configure Paymob, Bosta, WhatsApp, and Mail settings via the admin dashboard under Environment Settings, or set them in your `.env` file.
