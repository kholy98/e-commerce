<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactInquiryResource;
use App\Http\Resources\ContactInquiryResourceCollection;
use App\Mail\ContactInquiryReply;
use App\Models\ContactInquiry;
use App\Services\ContactInquiryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactInquiryController extends Controller
{
    public function __construct(
        protected ContactInquiryService $inquiryService
    ) {}

    /**
     * Display a listing of contact inquiries.
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
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_id' => 'nullable|exists:services,id',
            'service' => 'nullable|string|max:255', // Keep for backward compatibility
            'message' => 'required|string',
        ]);

        // If service_id is provided, use it; otherwise keep the service string
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
     */
    public function show(ContactInquiry $inquiry): JsonResponse
    {
        return (new ContactInquiryResource($inquiry))->response();
    }

    /**
     * Update the specified contact inquiry in storage.
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
     */
    public function destroy(ContactInquiry $inquiry): JsonResponse
    {
        $this->inquiryService->delete($inquiry);

        return response()->json(['message' => 'Inquiry deleted successfully']);
    }
}
