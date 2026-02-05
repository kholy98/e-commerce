# Draft: Contact Inquiry Publishing Feature

## Current Structure (Discovered)

### Database Schema

**contact_inquiries table:**

- id, full_name, email, phone, company, message
- status: enum('pending', 'replied', 'closed') - default: pending
- replied_at, reply_message
- timestamps

**No `is_published` field exists yet**

### Existing Controllers

- `ContactInquiryController` - Full REST API (index, show, store, update, patch, destroy, reply)
- `ContactInquiryAdminController` - Admin actions (reply, updateStatus)

### Routes

- Public API: `/contact-inquiries` (index, show, store, etc.)
- Admin Web: `/admin/inquiries` (Inertia pages)
- Admin API: `/admin/*` under auth middleware

### Frontend

- `/resources/js/Pages/admin/inquiries/index.tsx` - List view
- `/resources/js/Pages/admin/inquiries/show.tsx` - Detail + reply form

## Pattern References

- Product/Category models use `is_active` boolean for visibility
- Status field tracks workflow state (pending → replied → closed)

## User Requirements

1. Admin API endpoint to publish inquiries
2. Public API endpoint to view only published inquiries
3. Frontend will display as testimonial cards (per image)

## Decisions Made

### 1. Publishing Field Design

**Decision**: Add `is_published` boolean field

- Follows existing Product/Category pattern
- Keeps workflow status separate from visibility
- Migration: `$table->boolean('is_published')->default(false)`

### 2. Public API Response

**Decision**: Limited testimonial-style fields only

- Include: `full_name`, `company`, `message`, `created_at`
- Exclude: `email`, `phone`, `id` (for privacy)
- Create new `PublishedInquiryResource` for this

### 3. Publishing Restrictions

**Decision**: Only 'replied' inquiries can be published

- Prevents publishing spam/unhandled inquiries
- Admin must reply first before publishing
- Validation: `if ($inquiry->status !== 'replied')` → 422 error

### 4. Testing

**Decision**: Yes, include Pest tests

- Feature tests for both API endpoints
- Test publishing restrictions
- Test public API only returns published inquiries
