<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryReply;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactInquiryAdminController extends Controller
{
    /**
     * Reply to a contact inquiry
     */
    public function reply(Request $request, ContactInquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Check if already replied
        if ($inquiry->status === 'replied') {
            return redirect()->back()->with('error', 'This inquiry has already been replied to.');
        }

        // Send email
        Mail::to($inquiry->email)->send(new ContactInquiryReply($inquiry, $validated['reply_message']));

        // Update inquiry status
        $inquiry->update([
            'status' => 'replied',
            'reply_message' => $validated['reply_message'],
            'replied_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

    /**
     * Update inquiry status
     */
    public function updateStatus(Request $request, ContactInquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,replied,closed',
        ]);

        $inquiry->update($validated);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Toggle publish status for a contact inquiry
     */
    public function publish(Request $request, ContactInquiry $inquiry): RedirectResponse
    {
        // Only allow publishing if inquiry has been replied
        if (! $inquiry->is_published && $inquiry->status !== 'replied') {
            return redirect()->back()->with('error', 'Only replied inquiries can be published.');
        }

        $inquiry->update([
            'is_published' => ! $inquiry->is_published,
        ]);

        $message = $inquiry->is_published
            ? 'Inquiry published successfully.'
            : 'Inquiry unpublished successfully.';

        return redirect()->back()->with('success', $message);
    }
}
