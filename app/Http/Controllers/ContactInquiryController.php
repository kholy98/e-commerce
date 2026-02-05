<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactInquiryPublicResource;
use App\Http\Resources\ContactInquiryResource;
use App\Http\Resources\ContactInquiryResourceCollection;
use App\Mail\ContactInquiryReply;
use App\Models\ContactInquiry;
use App\Services\ContactInquiryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @group Contact Inquiries
 *
 * APIs for managing contact inquiries and customer testimonials.
 */
class ContactInquiryController extends Controller
{
    public function __construct(
        protected ContactInquiryService $inquiryService
    ) {}

    /**
     * Display a listing of contact inquiries.
     *
     * Get a paginated list of all contact inquiries.
     *
     * @authenticated
     *
     * @queryParam per_page integer Items per page. Default: 15. Example: 10
     * @queryParam status string Filter by status (pending, replied, closed). Example: pending
     *
     * @response 200 scenario="Success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "full_name": "John Doe",
     *       "email": "john@example.com",
     *       "phone": "+1234567890",
     *       "company": "Acme Inc",
     *       "message": "Interested in your products",
     *       "status": "pending",
     *       "status_label": "Pending",
     *       "status_color": "yellow",
     *       "replied_at": null,
     *       "reply_message": null,
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request): ContactInquiryResourceCollection
    {
        $perPage = $request->get('per_page', 15);
        $status = $request->get('status');

        if ($status) {
            $inquiries = $this->inquiryService->getByStatus($status, $perPage);
        } else {
            $inquiries = $this->inquiryService->getAllPaginated($perPage);
        }

        return new ContactInquiryResourceCollection($inquiries);
    }

    /**
     * Store a newly created contact inquiry in storage.
     *
     * Create a new contact inquiry from customer submission.
     *
     * @unauthenticated
     *
     * @bodyParam full_name string required The full name of the contact. Example: John Doe
     * @bodyParam email string required The email address. Example: john@example.com
     * @bodyParam phone string optional The phone number. Example: +1234567890
     * @bodyParam company string optional The company name. Example: Acme Inc
     * @bodyParam service_id integer optional The service ID if applicable. Example: 1
     * @bodyParam service string optional The service name (legacy). Example: Product Inquiry
     * @bodyParam message string required The inquiry message. Example: I'm interested in your products.
     *
     * @response 201 scenario="Created" {
     *   "id": 1,
     *   "full_name": "John Doe",
     *   "email": "john@example.com",
     *   "phone": "+1234567890",
     *   "company": "Acme Inc",
     *   "message": "I'm interested in your products.",
     *   "status": "pending",
     *   "status_label": "Pending",
     *   "status_color": "yellow",
     *   "replied_at": null,
     *   "reply_message": null,
     *   "created_at": "2024-01-15T10:00:00.000000Z",
     *   "updated_at": "2024-01-15T10:00:00.000000Z"
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The full name field is required.",
     *   "errors": {
     *     "full_name": ["The full name field is required."]
     *   }
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if (isset($validated['service_id'])) {
            $validated['service_id'] = $validated['service_id'];
        }

        $inquiry = $this->inquiryService->create($validated);

        return (new ContactInquiryResource($inquiry))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified contact inquiry.
     *
     * Get details of a specific contact inquiry.
     *
     * @authenticated
     * @urlParam inquiry integer required The inquiry ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "id": 1,
     *   "full_name": "John Doe",
     *   "email": "john@example.com",
     *   "phone": "+1234567890",
     *   "company": "Acme Inc",
     *   "message": "Interested in your products",
     *   "status": "pending",
     *   "status_label": "Pending",
     *   "status_color": "yellow",
     *   "replied_at": null,
     *   "reply_message": null,
     *   "created_at": "2024-01-15T10:00:00.000000Z",
     *   "updated_at": "2024-01-15T10:00:00.000000Z"
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Resource not found."
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function show(ContactInquiry $inquiry): JsonResponse
    {
        return (new ContactInquiryResource($inquiry))->response();
    }

    /**
     * Update the specified contact inquiry in storage.
     *
     * @authenticated
     * @urlParam inquiry integer required The inquiry ID. Example: 1
     *
     * @bodyParam full_name string optional The full name. Example: Jane Doe
     * @bodyParam email string optional The email address. Example: jane@example.com
     * @bodyParam phone string optional The phone number. Example: +9876543210
     * @bodyParam company string optional The company name. Example: XYZ Corp
     * @bodyParam service_id integer nullable optional The service ID. Example: 2
     * @bodyParam service string nullable optional The service name. Example: Support
     * @bodyParam message string optional The inquiry message. Example: Updated message.
     * @bodyParam status string optional The status (pending, replied, closed). Example: replied
     *
     * @response 200 scenario="Success" {
     *   "id": 1,
     *   "full_name": "Jane Doe",
     *   "email": "jane@example.com",
     *   "phone": "+9876543210",
     *   "company": "XYZ Corp",
     *   "message": "Updated message.",
     *   "status": "replied",
     *   "status_label": "Replied",
     *   "status_color": "green",
     *   "replied_at": "2024-01-15T10:30:00.000000Z",
     *   "reply_message": null,
     *   "created_at": "2024-01-15T10:00:00.000000Z",
     *   "updated_at": "2024-01-15T10:30:00.000000Z"
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Resource not found."
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The status must be one of: pending, replied, closed.",
     *   "errors": {
     *     "status": ["The status must be one of: pending, replied, closed."]
     *   }
     * }
     */
    public function update(Request $request, ContactInquiry $inquiry): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_id' => 'sometimes|nullable|exists:services,id',
            'service' => 'sometimes|nullable|string|max:255',
            'message' => 'sometimes|string',
            'status' => 'sometimes|in:pending,replied,closed',
        ]);

        $inquiry = $this->inquiryService->update($inquiry, $validated);

        return (new ContactInquiryResource($inquiry))->response();
    }

    /**
     * Partially update the specified contact inquiry in storage.
     */
    public function patch(Request $request, ContactInquiry $inquiry): JsonResponse
    {
        return $this->update($request, $inquiry);
    }

    /**
     * Reply to a contact inquiry.
     *
     * Send a reply email to the inquiry sender and update the inquiry status.
     *
     * @authenticated
     * @urlParam inquiry integer required The inquiry ID. Example: 1
     *
     * @bodyParam reply_message string required The reply message to send. Example: Thank you for your inquiry. We will get back to you shortly.
     *
     * @response 200 scenario="Success" {
     *   "id": 1,
     *   "full_name": "John Doe",
     *   "email": "john@example.com",
     *   "phone": "+1234567890",
     *   "company": "Acme Inc",
     *   "message": "Interested in your products",
     *   "status": "replied",
     *   "status_label": "Replied",
     *   "status_color": "green",
     *   "replied_at": "2024-01-15T10:30:00.000000Z",
     *   "reply_message": "Thank you for your inquiry. We will get back to you shortly.",
     *   "created_at": "2024-01-15T10:00:00.000000Z",
     *   "updated_at": "2024-01-15T10:30:00.000000Z"
     * }
     * @response 400 scenario="Already Replied" {
     *   "message": "This inquiry has already been replied to."
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Resource not found."
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The reply message field is required.",
     *   "errors": {
     *     "reply_message": ["The reply message field is required."]
     *   }
     * }
     */
    public function reply(Request $request, ContactInquiry $inquiry): JsonResponse
    {
        $validated = $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Check if already replied
        if ($inquiry->status === 'replied') {
            return response()->json([
                'message' => 'This inquiry has already been replied to.',
            ], 400);
        }

        // Send email
        Mail::to($inquiry->email)->send(new ContactInquiryReply($inquiry, $validated['reply_message']));

        // Update inquiry status
        $inquiry = $this->inquiryService->replyToInquiry($inquiry, $validated['reply_message']);

        return (new ContactInquiryResource($inquiry))->response();
    }

    /**
     * Remove the specified contact inquiry from storage.
     *
     * @authenticated
     * @urlParam inquiry integer required The inquiry ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "message": "Inquiry deleted successfully"
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Resource not found."
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(ContactInquiry $inquiry): JsonResponse
    {
        $this->inquiryService->delete($inquiry);

        return response()->json(['message' => 'Inquiry deleted successfully']);
    }

    /**
     * Display a listing of published inquiries (for testimonials).
     *
     * Get a paginated list of published contact inquiries.
     * Only inquiries that have been replied to and marked as published are returned.
     * Sensitive fields like email and phone are excluded from the response.
     *
     * @unauthenticated
     *
     * @queryParam per_page integer Items per page. Default: 10. Example: 15
     *
     * @response 200 scenario="Success" {
     *   "data": [
     *     {
     *       "full_name": "John Doe",
     *       "company": "Acme Inc",
     *       "message": "Great service! Very satisfied with the quality.",
     *       "reply_message": "Thank you for your feedback! We're glad you're happy.",
     *       "created_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "last_page": 5,
     *     "per_page": 10,
     *     "total": 50
     *   }
     * }
     */
    public function published(Request $request): \Illuminate\Http\JsonResponse
    {
        $inquiries = ContactInquiry::published()
            ->where('status', 'replied')
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'data' => ContactInquiryPublicResource::collection($inquiries),
            'meta' => [
                'current_page' => $inquiries->currentPage(),
                'last_page' => $inquiries->lastPage(),
                'per_page' => $inquiries->perPage(),
                'total' => $inquiries->total(),
            ],
        ]);
    }

    /**
     * Display a listing of all inquiries (admin view).
     *
     * Get a paginated list of all contact inquiries including unpublished ones.
     *
     * @authenticated
     * @subgroup Admin Management
     *
     * @queryParam per_page integer Items per page. Default: 15. Example: 10
     * @queryParam status string Filter by status (pending, replied, closed). Example: pending
     *
     * @response 200 scenario="Success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "full_name": "John Doe",
     *       "email": "john@example.com",
     *       "phone": "+1234567890",
     *       "company": "Acme Inc",
     *       "message": "Interested in your products",
     *       "status": "pending",
     *       "status_label": "Pending",
     *       "status_color": "yellow",
     *       "replied_at": null,
     *       "reply_message": null,
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     * @response 403 scenario="Forbidden" {
     *   "message": "This action is unauthorized."
     * }
     */
    public function adminIndex(Request $request): ContactInquiryResourceCollection
    {
        $perPage = $request->get('per_page', 15);
        $status = $request->get('status');

        $query = ContactInquiry::query();

        if ($status) {
            $query->where('status', $status);
        }

        $inquiries = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return new ContactInquiryResourceCollection($inquiries);
    }

    /**
     * Publish a contact inquiry.
     *
     * Mark a contact inquiry as published so it appears in public testimonials.
     * Only inquiries that have been replied to can be published.
     *
     * @authenticated
     * @subgroup Admin Management
     * @urlParam inquiry integer required The inquiry ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "message": "Inquiry published successfully.",
     *   "data": {
     *     "id": 1,
     *     "full_name": "John Doe",
     *     "email": "john@example.com",
     *     "phone": "+1234567890",
     *     "company": "Acme Inc",
     *     "message": "Great service!",
     *     "status": "replied",
     *     "status_label": "Replied",
     *     "status_color": "green",
     *     "replied_at": "2024-01-15T10:30:00.000000Z",
     *     "reply_message": "Thank you for your feedback!",
     *     "created_at": "2024-01-15T10:00:00.000000Z",
     *     "updated_at": "2024-01-15T10:30:00.000000Z"
     *   }
     * }
     * @response 403 scenario="Not Replied" {
     *   "message": "Only replied inquiries can be published."
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Resource not found."
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function publish(Request $request, ContactInquiry $inquiry): JsonResponse
    {
        // Only allow publishing if inquiry has been replied
        if ($inquiry->status !== 'replied') {
            return response()->json([
                'message' => 'Only replied inquiries can be published.',
            ], 403);
        }

        $inquiry->update(['is_published' => true]);

        return response()->json([
            'message' => 'Inquiry published successfully.',
            'data' => new ContactInquiryResource($inquiry),
        ]);
    }

    /**
     * Unpublish a contact inquiry.
     *
     * Mark a published contact inquiry as unpublished.
     *
     * @authenticated
     * @subgroup Admin Management
     * @urlParam inquiry integer required The inquiry ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "message": "Inquiry unpublished successfully.",
     *   "data": {
     *     "id": 1,
     *     "full_name": "John Doe",
     *     "email": "john@example.com",
     *     "phone": "+1234567890",
     *     "company": "Acme Inc",
     *     "message": "Great service!",
     *     "status": "replied",
     *     "status_label": "Replied",
     *     "status_color": "green",
     *     "replied_at": "2024-01-15T10:30:00.000000Z",
     *     "reply_message": "Thank you for your feedback!",
     *     "created_at": "2024-01-15T10:00:00.000000Z",
     *     "updated_at": "2024-01-15T10:35:00.000000Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Resource not found."
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function unpublish(Request $request, ContactInquiry $inquiry): JsonResponse
    {
        $inquiry->update(['is_published' => false]);

        return response()->json([
            'message' => 'Inquiry unpublished successfully.',
            'data' => new ContactInquiryResource($inquiry),
        ]);
    }
}
