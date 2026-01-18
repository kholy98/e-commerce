<?php

namespace App\Services;

use App\Models\ContactInquiry;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactInquiryService
{
    /**
     * Get all inquiries with pagination.
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return ContactInquiry::latest()->paginate($perPage);
    }

    /**
     * Get an inquiry by ID.
     */
    public function findById(int $id): ?ContactInquiry
    {
        return ContactInquiry::find($id);
    }

    /**
     * Create a new inquiry.
     */
    public function create(array $data): ContactInquiry
    {
        return ContactInquiry::create($data);
    }

    /**
     * Update an inquiry.
     */
    public function update(ContactInquiry $inquiry, array $data): ContactInquiry
    {
        $inquiry->update($data);

        return $inquiry->fresh();
    }

    /**
     * Delete an inquiry.
     */
    public function delete(ContactInquiry $inquiry): bool
    {
        return $inquiry->delete();
    }

    /**
     * Reply to an inquiry and update its status.
     */
    public function replyToInquiry(ContactInquiry $inquiry, string $replyMessage): ContactInquiry
    {
        return $this->update($inquiry, [
            'status' => 'replied',
            'replied_at' => now(),
            'reply_message' => $replyMessage,
        ]);
    }

    /**
     * Get inquiries by status.
     */
    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator
    {
        return ContactInquiry::status($status)->latest()->paginate($perPage);
    }

    /**
     * Get pending inquiries count.
     */
    public function getPendingCount(): int
    {
        return ContactInquiry::pending()->count();
    }
}
