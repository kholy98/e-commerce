<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminContactUsController extends Controller
{
    public function show(): JsonResponse
    {
        $contactUs = ContactUs::first();

        return response()->json([
            'success' => true,
            'data' => $contactUs ?? new ContactUs,
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'phones' => 'nullable|array',
            'phones.*' => 'string',
            'emails' => 'nullable|array',
            'emails.*' => 'email',
            'addresses_en' => 'nullable|array',
            'addresses_en.*' => 'string',
            'addresses_ar' => 'nullable|array',
            'addresses_ar.*' => 'string',
            'working_hours_en' => 'nullable|array',
            'working_hours_en.*' => 'string',
            'working_hours_ar' => 'nullable|array',
            'working_hours_ar.*' => 'string',
        ]);

        $contactUs = ContactUs::first();

        if ($contactUs) {
            $contactUs->update($validated);
        } else {
            ContactUs::create($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Contact us updated successfully',
        ]);
    }
}
