<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;

class ContactUsController extends Controller
{
    public function index(): JsonResponse
    {
        $contactUs = ContactUs::first();

        if (! $contactUs) {
            return response()->json([
                'success' => false,
                'message' => 'Contact us data not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'en' => [
                    'phones' => $contactUs->phones ?? [],
                    'emails' => $contactUs->emails ?? [],
                    'addresses' => $contactUs->addresses_en ?? [],
                    'working_hours' => $contactUs->working_hours_en ?? [],
                ],
                'ar' => [
                    'phones' => $contactUs->phones ?? [],
                    'emails' => $contactUs->emails ?? [],
                    'addresses' => $contactUs->addresses_ar ?? [],
                    'working_hours' => $contactUs->working_hours_ar ?? [],
                ],
            ],
        ]);
    }
}
