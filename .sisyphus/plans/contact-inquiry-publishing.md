# Contact Inquiry Publishing Feature

## TL;DR

> **Quick Summary**: Add publishing capability to contact inquiries, allowing admins to mark replied inquiries as public testimonials. Includes admin publish toggle API and public testimonial-viewing endpoint.
>
> **Deliverables**:
>
> - Database migration adding `is_published` boolean
> - Model updates with scope and casts
> - Admin API endpoint to publish/unpublish inquiries
> - Public API endpoint for published testimonials only
> - Frontend publish toggle button in admin dashboard
> - Pest feature tests for both endpoints
>
> **Estimated Effort**: Medium
> **Parallel Execution**: NO - Sequential (migration must run first)
> **Critical Path**: Migration → Model → Admin API → Public API → Frontend → Tests

---

## Context

### Original Request

User wants to add functionality to publish contact inquiries that admins choose:

1. Admin API endpoint to publish the inquiry
2. Public API endpoint to view only published inquiries for the frontend (testimonial display)

### Interview Summary

**Key Discussions**:

- **Publishing field design**: Add `is_published` boolean field (follows Product/Category pattern)
- **Public API response**: Limited testimonial-style fields only (full_name, company, message, created_at) - hides email/phone for privacy
- **Publishing restrictions**: Only 'replied' inquiries can be published (prevents publishing spam)
- **Testing**: Include Pest feature tests

### Metis Review

**Identified Gaps** (addressed):

- **Scope pattern**: ContactInquiry uses scope methods (scopePending, scopeReplied), should add scopePublished()
- **Service layer**: ContactInquiryService exists but Admin controller handles actions directly - follow existing pattern
- **Migration pattern**: Use `$table->boolean('is_published')->default(false)->index()` (default false, add index)
- **published_at timestamp**: Skipping for simplicity (not requested)

---

## Work Objectives

### Core Objective

Enable admins to publish contact inquiries as public testimonials, with a clean separation between workflow status (pending/replied/closed) and visibility status (published/unpublished).

### Concrete Deliverables

- Database migration: `add_is_published_to_contact_inquiries_table`
- Model updates: ContactInquiry.php (fillable, casts, scopePublished)
- Admin API: POST `/admin/inquiries/{inquiry}/publish` (toggle is_published)
- Public API: GET `/contact-inquiries/published` (returns only published, limited fields)
- Resource: PublishedInquiryResource.php (testimonial-style response)
- Frontend: Publish toggle button in admin/inquiries/show.tsx
- Tests: Feature tests for publish endpoint and public endpoint

### Definition of Done

- [x] Migration runs successfully and adds column
- [x] Admin can publish/unpublish inquiries from dashboard
- [x] Only replied inquiries can be published (validation enforced)
- [x] Public API returns only published inquiries with limited fields
- [x] All tests pass: `php artisan test --filter=ContactInquiry`

### Must Have

- `is_published` boolean field with index
- Admin publish toggle endpoint
- Public testimonials endpoint
- Validation: only replied inquiries publishable
- Frontend publish button
- Pest feature tests

### Must NOT Have (Guardrails)

- Do NOT modify existing status enum values
- Do NOT expose email/phone in public API
- Do NOT allow publishing pending/closed inquiries
- Do NOT remove or modify existing inquiry functionality

---

## Verification Strategy (MANDATORY)

> **UNIVERSAL RULE: ZERO HUMAN INTERVENTION**
>
> ALL tasks in this plan MUST be verifiable WITHOUT any human action.

### Test Decision

- **Infrastructure exists**: YES (Pest v4 installed)
- **Automated tests**: Tests-after (implementation first, then tests)
- **Framework**: Pest 4 with Laravel assertions

### Agent-Executed QA Scenarios (MANDATORY - ALL tasks)

**Verification Tool by Deliverable Type:**

- **API/Backend**: Bash (curl/httpie)
- **Database**: Bash (artisan migrate:status)
- **Frontend/UI**: Playwright

---

## Execution Strategy

### Sequential Execution (No Parallelism)

All tasks must execute sequentially due to dependencies:

```
Wave 1: Database
├── Task 1: Create migration for is_published column

Wave 2: Backend Model
├── Task 2: Update ContactInquiry model

Wave 3: Admin API
├── Task 3: Add publish endpoint to ContactInquiryAdminController
├── Task 4: Add admin API route

Wave 4: Public API
├── Task 5: Add published endpoint to ContactInquiryController
├── Task 6: Create PublishedInquiryResource
├── Task 7: Add public API route

Wave 5: Frontend
├── Task 8: Add publish toggle button to show.tsx

Wave 6: Testing
├── Task 9: Write feature tests
```

---

## TODOs

- [x]   1. Create Database Migration

    **What to do**:
    - Create migration: `php artisan make:migration add_is_published_to_contact_inquiries_table`
    - Add column: `$table->boolean('is_published')->default(false)->index()`
    - Add down() method to drop column

    **Must NOT do**:
    - Do NOT add published_at timestamp (not requested)
    - Do NOT set default to true (new inquiries shouldn't auto-publish)

    **Recommended Agent Profile**:
    - **Category**: `unspecified-low`
    - **Skills**: None needed (simple migration)
    - **Reason**: Basic Laravel migration task

    **Parallelization**:
    - **Can Run In Parallel**: NO
    - **Blocks**: Task 2, 3, 4, 5, 6, 7, 8, 9
    - **Blocked By**: None (first task)

    **References**:
    - Pattern: `database/migrations/*_create_products_table.php` - shows `is_active` with index
    - Docs: `search-docs` query: ["migrations boolean"]

    **Acceptance Criteria**:
    - [ ] Migration file created at `database/migrations/[timestamp]_add_is_published_to_contact_inquiries_table.php`
    - [ ] Bash: `php artisan migrate:status` shows migration as "Ran"
    - [ ] Database query: `SELECT sql FROM sqlite_master WHERE name='contact_inquiries'` contains "is_published"

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Migration creates is_published column
      Tool: Bash
      Preconditions: Fresh database or rollback state
      Steps:
        1. Run: php artisan migrate --path=database/migrations/[timestamp]_add_is_published_to_contact_inquiries_table.php
        2. Assert: Exit code 0
        3. Run: sqlite3 database/database.sqlite "PRAGMA table_info(contact_inquiries)" | grep is_published
        4. Assert: Output contains "is_published"
      Expected Result: Column exists with boolean type, default false
      Evidence: Migration output captured
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add is_published column to contact_inquiries`
    - Files: `database/migrations/*_add_is_published_to_contact_inquiries_table.php`

---

- [x]   2. Update ContactInquiry Model

    **What to do**:
    - Add 'is_published' to $fillable array
    - Add 'is_published' => 'boolean' to casts() method
    - Add scopePublished() method following existing scope pattern

    **Must NOT do**:
    - Do NOT remove any existing fillable fields
    - Do NOT change existing status enum values

    **Recommended Agent Profile**:
    - **Category**: `quick`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: NO (depends on Task 1)
    - **Blocks**: Task 3, 5
    - **Blocked By**: Task 1

    **References**:
    - Pattern: `app/Models/ContactInquiry.php:78-88` - scopePending(), scopeReplied() methods
    - Pattern: `app/Models/ContactInquiry.php:34-38` - casts() method structure

    **Code to Add**:

    ```php
    // In $fillable array, add:
    'is_published',

    // In casts() method, add:
    'is_published' => 'boolean',

    // Add new scope method after scopeReplied():
    /**
     * Scope to get published inquiries.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
    ```

    **Acceptance Criteria**:
    - [ ] 'is_published' added to $fillable
    - [ ] 'is_published' => 'boolean' added to casts()
    - [ ] scopePublished() method exists
    - [ ] Tinker: `ContactInquiry::published()->toSql()` returns query with where clause

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Model has published scope
      Tool: Bash (Tinker)
      Preconditions: Model updated
      Steps:
        1. Run: php artisan tinker --execute="echo ContactInquiry::published()->toSql();"
        2. Assert: Output contains "is_published" and "true"
      Expected Result: Scope generates correct query
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add is_published to ContactInquiry model`
    - Files: `app/Models/ContactInquiry.php`

---

- [x]   3. Add Publish Endpoint to Admin Controller

    **What to do**:
    - Add `publish()` method to `ContactInquiryAdminController`
    - Validate inquiry status is 'replied' before publishing
    - Toggle is_published boolean
    - Return redirect with success message

    **Must NOT do**:
    - Do NOT allow publishing if status !== 'replied'
    - Do NOT use Service layer (follow existing reply() pattern)

    **Recommended Agent Profile**:
    - **Category**: `quick`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: NO (depends on Task 2)
    - **Blocks**: Task 4
    - **Blocked By**: Task 2

    **References**:
    - Pattern: `app/Http/Controllers/ContactInquiryAdminController.php:17-39` - reply() method structure
    - Pattern: `app/Http/Controllers/ContactInquiryAdminController.php:42-53` - updateStatus() method

    **Code to Add**:

    ```php
    /**
     * Toggle publish status for a contact inquiry
     */
    public function publish(Request $request, ContactInquiry $inquiry): RedirectResponse
    {
        // Only allow publishing if inquiry has been replied
        if (!$inquiry->is_published && $inquiry->status !== 'replied') {
            return redirect()->back()->with('error', 'Only replied inquiries can be published.');
        }

        $inquiry->update([
            'is_published' => !$inquiry->is_published,
        ]);

        $message = $inquiry->is_published
            ? 'Inquiry published successfully.'
            : 'Inquiry unpublished successfully.';

        return redirect()->back()->with('success', $message);
    }
    ```

    **Acceptance Criteria**:
    - [ ] publish() method exists in ContactInquiryAdminController
    - [ ] Validates status is 'replied' before publishing
    - [ ] Toggles is_published boolean
    - [ ] Returns appropriate success message

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Publish replied inquiry succeeds
      Tool: Bash (curl)
      Preconditions: Replied inquiry exists (id=1)
      Steps:
        1. POST /admin/inquiries/1/publish (with CSRF/session)
        2. Assert: Response redirects
        3. Query: ContactInquiry::find(1)->is_published === true
      Expected Result: is_published set to true

    Scenario: Publish pending inquiry fails
      Tool: Bash (curl)
      Preconditions: Pending inquiry exists (id=2)
      Steps:
        1. POST /admin/inquiries/2/publish
        2. Assert: Response contains error message
        3. Query: ContactInquiry::find(2)->is_published === false
      Expected Result: is_published remains false, error shown
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add publish endpoint to admin controller`
    - Files: `app/Http/Controllers/ContactInquiryAdminController.php`

---

- [x]   4. Add Admin API Route

    **What to do**:
    - Add POST route for `/admin/inquiries/{inquiry}/publish` in routes/web.php
    - Place inside existing admin route group

    **Must NOT do**:
    - Do NOT create separate route file
    - Do NOT use api routes (admin uses web routes with session auth)

    **Recommended Agent Profile**:
    - **Category**: `quick`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: NO (depends on Task 3)
    - **Blocks**: Task 8
    - **Blocked By**: Task 3

    **References**:
    - Pattern: `routes/web.php:98-99` - existing inquiry routes
    - Pattern: `routes/web.php:18` - admin route group with middleware

    **Code to Add** (after line 99):

    ```php
    Route::post('inquiries/{inquiry}/publish', [\App\Http\Controllers\ContactInquiryAdminController::class, 'publish'])->name('inquiries.publish');
    ```

    **Acceptance Criteria**:
    - [ ] Route registered: `php artisan route:list | grep inquiries.publish`
    - [ ] Route has correct middleware (web, auth, verified, admin)

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Route is registered correctly
      Tool: Bash
      Steps:
        1. Run: php artisan route:list --name=inquiries.publish
        2. Assert: Output shows POST /admin/inquiries/{inquiry}/publish
        3. Assert: Middleware includes admin
      Expected Result: Route exists with correct middleware
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add admin publish route`
    - Files: `routes/web.php`

---

- [x]   5. Add Published Endpoint to Public Controller

    **What to do**:
    - Add `published()` method to `ContactInquiryController`
    - Return paginated list of only published inquiries
    - Use PublishedInquiryResource for response

    **Must NOT do**:
    - Do NOT require authentication (this is a public endpoint)
    - Do NOT return email, phone, or id fields

    **Recommended Agent Profile**:
    - **Category**: `quick`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: YES (independent of Tasks 3-4)
    - **Blocks**: Task 7
    - **Blocked By**: Task 2

    **References**:
    - Pattern: `app/Http/Controllers/ContactInquiryController.php` - index() method structure
    - Pattern: `app/Http/Resources/ContactInquiryResource.php` - resource structure

    **Code to Add**:

    ```php
    /**
     * Display a listing of published inquiries (for testimonials)
     */
    public function published(Request $request): ContactInquiryResourceCollection
    {
        $inquiries = ContactInquiry::published()
            ->where('status', 'replied')  // Double-check: only replied inquiries
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 10));

        return new ContactInquiryResourceCollection($inquiries);
    }
    ```

    **Acceptance Criteria**:
    - [ ] published() method exists
    - [ ] Returns only inquiries where is_published = true
    - [ ] Results ordered by created_at desc
    - [ ] Supports pagination

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Public endpoint returns only published inquiries
      Tool: Bash (curl)
      Preconditions: 3 inquiries exist (1 published, 2 unpublished)
      Steps:
        1. GET /api/contact-inquiries/published
        2. Assert: Response status 200
        3. Assert: Response JSON contains exactly 1 inquiry
        4. Assert: Returned inquiry has is_published=true
      Expected Result: Only published inquiries returned
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add published endpoint to public controller`
    - Files: `app/Http/Controllers/ContactInquiryController.php`

---

- [x]   6. Create PublishedInquiryResource

    **What to do**:
    - Create new resource class: `PublishedInquiryResource`
    - Return only testimonial-style fields: full_name, company, message, created_at
    - Exclude: id, email, phone, status, replied_at, reply_message, updated_at

    **Must NOT do**:
    - Do NOT include sensitive fields (email, phone, id)
    - Do NOT modify ContactInquiryResource (keep it for admin use)

    **Recommended Agent Profile**:
    - **Category**: `quick`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: YES (independent)
    - **Blocks**: Task 5 (if Task 5 references it)
    - **Blocked By**: None

    **References**:
    - Pattern: `app/Http/Resources/ContactInquiryResource.php` - structure

    **Code** (new file):

    ```php
    <?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class PublishedInquiryResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array
        {
            return [
                'full_name' => $this->full_name,
                'company' => $this->company,
                'message' => $this->message,
                'created_at' => $this->created_at,
            ];
        }
    }
    ```

    **Acceptance Criteria**:
    - [ ] File created at `app/Http/Resources/PublishedInquiryResource.php`
    - [ ] Contains only full_name, company, message, created_at
    - [ ] No sensitive fields included

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Resource excludes sensitive fields
      Tool: Bash (Tinker)
      Steps:
        1. Create test inquiry with all fields
        2. Run: (new PublishedInquiryResource($inquiry))->toArray(new Request())
        3. Assert: Array has only keys: full_name, company, message, created_at
        4. Assert: Array does NOT have keys: id, email, phone
      Expected Result: Only allowed fields present
    ```

    **Commit**: YES
    - Message: `feat(inquiries): create PublishedInquiryResource for testimonials`
    - Files: `app/Http/Resources/PublishedInquiryResource.php`

---

- [x]   7. Add Public API Route

    **What to do**:
    - Add GET route for `/contact-inquiries/published` in routes/api.php
    - Place outside middleware groups (public route)

    **Must NOT do**:
    - Do NOT place inside auth middleware
    - Do NOT require authentication

    **Recommended Agent Profile**:
    - **Category**: `quick`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: NO (depends on Tasks 5-6)
    - **Blocks**: Task 9
    - **Blocked By**: Task 5, 6

    **References**:
    - Pattern: `routes/api.php:327-333` - existing contact-inquiries routes

    **Code to Add** (after line 333):

    ```php
    Route::get('contact-inquiries/published', [ContactInquiryController::class, 'published'])->name('api.contact-inquiries.published');
    ```

    **Acceptance Criteria**:
    - [ ] Route registered: `php artisan route:list | grep published`
    - [ ] Route is public (no auth middleware)

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Public route is accessible without auth
      Tool: Bash (curl)
      Steps:
        1. GET /api/contact-inquiries/published
        2. Assert: Status code 200 (not 401)
      Expected Result: Accessible without authentication
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add public published inquiries route`
    - Files: `routes/api.php`

---

- [x]   8. Add Publish Toggle Button to Frontend

    **What to do**:
    - Add publish/unpublish button to `/resources/js/Pages/admin/inquiries/show.tsx`
    - Button should only show for replied inquiries
    - Use existing useForm pattern for POST request
    - Show success/error flash messages

    **Must NOT do**:
    - Do NOT show button for pending/closed inquiries
    - Do NOT modify other inquiry functionality

    **Recommended Agent Profile**:
    - **Category**: `visual-engineering`
    - **Skills**: [`frontend-ui-ux`]
    - **Reason**: Frontend React/TypeScript work

    **Parallelization**:
    - **Can Run In Parallel**: NO (depends on Task 4)
    - **Blocks**: None
    - **Blocked By**: Task 4

    **References**:
    - Pattern: `resources/js/Pages/admin/inquiries/show.tsx:48-55` - useForm pattern
    - Pattern: `resources/js/Pages/admin/inquiries/show.tsx:176-205` - form submission
    - Wayfinder routes: Check if /admin/inquiries/{inquiry}/publish route exists

    **Code to Add** (in show.tsx, after Reply Form card):

    ```tsx
    {
        /* Publish Toggle */
    }
    {
        inquiry.status === 'replied' && (
            <Card>
                <CardHeader>
                    <CardTitle>
                        {inquiry.is_published ? 'Published' : 'Publish Inquiry'}
                    </CardTitle>
                </CardHeader>
                <CardContent>
                    <p className="mb-4 text-sm text-muted-foreground">
                        {inquiry.is_published
                            ? 'This inquiry is currently visible on the testimonials page.'
                            : 'Make this inquiry visible as a testimonial on the public site.'}
                    </p>
                    <form
                        action={`/admin/inquiries/${inquiry.id}/publish`}
                        method="post"
                    >
                        <input
                            type="hidden"
                            name="_token"
                            value={
                                document
                                    .querySelector('meta[name="csrf-token"]')
                                    ?.getAttribute('content') || ''
                            }
                        />
                        <Button
                            type="submit"
                            variant={
                                inquiry.is_published ? 'destructive' : 'default'
                            }
                        >
                            {inquiry.is_published ? 'Unpublish' : 'Publish'}
                        </Button>
                    </form>
                </CardContent>
            </Card>
        );
    }
    ```

    Also need to update the interface to include `is_published`:

    ```tsx
    interface ContactInquiry {
        // ... existing fields
        is_published?: boolean;
    }
    ```

    **Acceptance Criteria**:
    - [ ] Publish button visible for replied inquiries
    - [ ] Button hidden for pending/closed inquiries
    - [ ] Button toggles between "Publish" and "Unpublish"
    - [ ] Form submits to correct endpoint

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: Publish button visible for replied inquiry
      Tool: Playwright
      Preconditions: Replied inquiry exists, admin logged in
      Steps:
        1. Navigate to: /admin/inquiries/1
        2. Wait for: page loaded
        3. Assert: Button with text "Publish" is visible
        4. Assert: Button is in the third column (after Inquiry Details and Reply Form)
      Expected Result: Publish button present for replied inquiries

    Scenario: Publish button hidden for pending inquiry
      Tool: Playwright
      Preconditions: Pending inquiry exists
      Steps:
        1. Navigate to: /admin/inquiries/2 (pending)
        2. Wait for: page loaded
        3. Assert: Button with text "Publish" is NOT visible
      Expected Result: No publish button for pending inquiries
    ```

    **Commit**: YES
    - Message: `feat(inquiries): add publish toggle button to admin dashboard`
    - Files: `resources/js/Pages/admin/inquiries/show.tsx`

---

- [x]   9. Write Feature Tests

    **What to do**:
    - Create test file: `tests/Feature/ContactInquiryPublishingTest.php`
    - Test admin can publish replied inquiry
    - Test admin cannot publish pending/closed inquiry
    - Test public endpoint returns only published inquiries
    - Test public endpoint excludes sensitive fields

    **Must NOT do**:
    - Do NOT test existing functionality (only new publishing feature)
    - Do NOT remove existing tests

    **Recommended Agent Profile**:
    - **Category**: `unspecified-low`
    - **Skills**: None needed

    **Parallelization**:
    - **Can Run In Parallel**: NO (depends on all previous tasks)
    - **Blocks**: None
    - **Blocked By**: Tasks 1-8

    **References**:
    - Pattern: Check existing tests in `tests/Feature/` directory
    - Pattern: `search-docs` query: ["pest testing"]

    **Test Structure**:

    ```php
    <?php

    use App\Models\ContactInquiry;
    use App\Models\User;

    describe('Contact Inquiry Publishing', function () {
        beforeEach(function () {
            $this->admin = User::factory()->create(['is_admin' => true]);
        });

        it('allows admin to publish a replied inquiry', function () {
            $inquiry = ContactInquiry::factory()->create(['status' => 'replied']);

            actingAs($this->admin)
                ->post("/admin/inquiries/{$inquiry->id}/publish")
                ->assertRedirect();

            expect($inquiry->fresh()->is_published)->toBeTrue();
        });

        it('prevents publishing pending inquiries', function () {
            $inquiry = ContactInquiry::factory()->create(['status' => 'pending']);

            actingAs($this->admin)
                ->post("/admin/inquiries/{$inquiry->id}/publish")
                ->assertRedirect()
                ->assertSessionHas('error');

            expect($inquiry->fresh()->is_published)->toBeFalse();
        });

        it('returns only published inquiries on public endpoint', function () {
            ContactInquiry::factory()->create(['is_published' => true, 'status' => 'replied']);
            ContactInquiry::factory()->create(['is_published' => false, 'status' => 'replied']);

            $response = $this->getJson('/api/contact-inquiries/published');

            $response->assertOk()
                ->assertJsonCount(1, 'data');
        });

        it('excludes sensitive fields from public endpoint', function () {
            $inquiry = ContactInquiry::factory()->create([
                'is_published' => true,
                'status' => 'replied',
            ]);

            $response = $this->getJson('/api/contact-inquiries/published');

            $response->assertOk()
                ->assertJsonMissing(['email', 'phone', 'id'])
                ->assertJsonPath('data.0.full_name', $inquiry->full_name);
        });

        it('allows admin to unpublish a published inquiry', function () {
            $inquiry = ContactInquiry::factory()->create([
                'status' => 'replied',
                'is_published' => true,
            ]);

            actingAs($this->admin)
                ->post("/admin/inquiries/{$inquiry->id}/publish")
                ->assertRedirect();

            expect($inquiry->fresh()->is_published)->toBeFalse();
        });
    });
    ```

    **Acceptance Criteria**:
    - [ ] Test file created
    - [ ] All 5+ test cases pass: `php artisan test tests/Feature/ContactInquiryPublishingTest.php`

    **Agent-Executed QA Scenarios**:

    ```
    Scenario: All tests pass
      Tool: Bash
      Steps:
        1. Run: php artisan test tests/Feature/ContactInquiryPublishingTest.php --compact
        2. Assert: Exit code 0
        3. Assert: Output shows all tests passing
      Expected Result: 100% test pass rate
    ```

    **Commit**: YES
    - Message: `test(inquiries): add feature tests for publishing functionality`
    - Files: `tests/Feature/ContactInquiryPublishingTest.php`

---

## Commit Strategy

| After Task | Message                                            | Files                             | Verification                 |
| ---------- | -------------------------------------------------- | --------------------------------- | ---------------------------- |
| 1          | `feat(inquiries): add is_published column`         | migration file                    | `php artisan migrate:status` |
| 2          | `feat(inquiries): add is_published to model`       | ContactInquiry.php                | Tinker scope test            |
| 3          | `feat(inquiries): add publish endpoint`            | ContactInquiryAdminController.php | Route test                   |
| 4          | `feat(inquiries): add admin publish route`         | routes/web.php                    | `route:list`                 |
| 5          | `feat(inquiries): add published endpoint`          | ContactInquiryController.php      | API test                     |
| 6          | `feat(inquiries): create PublishedInquiryResource` | PublishedInquiryResource.php      | Field check                  |
| 7          | `feat(inquiries): add public published route`      | routes/api.php                    | `route:list`                 |
| 8          | `feat(inquiries): add publish toggle button`       | show.tsx                          | Playwright check             |
| 9          | `test(inquiries): add feature tests`               | ContactInquiryPublishingTest.php  | `php artisan test`           |

---

## Success Criteria

### Verification Commands

```bash
# 1. Migration applied
php artisan migrate:status | grep is_published

# 2. Routes registered
php artisan route:list --name=inquiries.publish
php artisan route:list --name=contact-inquiries.published

# 3. All tests pass
php artisan test tests/Feature/ContactInquiryPublishingTest.php --compact

# 4. Public API accessible
# (requires running server or curl to test)
curl http://localhost:8000/api/contact-inquiries/published
```

### Final Checklist

- [x] All "Must Have" present
- [x] All "Must NOT Have" absent
- [x] All tests pass
- [x] Database column exists with index
- [x] Admin can publish/unpublish from dashboard
- [x] Public API returns only published inquiries
- [x] Public API excludes sensitive fields
- [x] Only replied inquiries can be published
