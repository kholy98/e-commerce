<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @group User Management
 *
 * APIs for managing authenticated user data.
 */
class UserController extends Controller
{
    /**
     * Get authenticated user
     *
     * Retrieve the currently authenticated user's information including their addresses.
     *
     * @authenticated
     *
     * @response 200 scenario="Success" {
     *   "id": 1,
     *   "name": "John Doe",
     *   "email": "john@example.com",
     *   "phone": "+201234567890",
     *   "email_verified_at": "2024-01-15T10:00:00.000000Z",
     *   "created_at": "2024-01-15T10:00:00.000000Z",
     *   "updated_at": "2024-01-15T10:00:00.000000Z",
     *   "addresses": [
     *     {
     *       "id": 1,
     *       "user_id": 1,
     *       "label": "Home",
     *       "name": "John Doe",
     *       "phone": "+201234567890",
     *       "address": "123 Main St, Cairo, Egypt",
     *       "city": "Cairo",
     *       "country": "Egypt",
     *       "is_default": true,
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load(['addresses' => function ($query) {
            $query->orderBy('is_default', 'desc')->orderBy('created_at', 'desc');
        }]);

        return response()->json($user);
    }

    /**
     * Update authenticated user
     *
     * Update the authenticated user's profile information.
     *
     * @authenticated
     *
     * @bodyParam name string optional The user's full name. Example: John Doe Updated
     * @bodyParam email string optional The user's email address (must be unique). Example: john.updated@example.com
     * @bodyParam phone string optional The user's phone number. Example: +201234567891
     * @bodyParam password string optional The new password (minimum 8 characters). Example: newpassword123
     * @bodyParam password_confirmation string optional Password confirmation (must match password). Example: newpassword123
     *
     * @response 200 scenario="Success" {
     *   "id": 1,
     *   "name": "John Doe Updated",
     *   "email": "john.updated@example.com",
     *   "phone": "+201234567891",
     *   "email_verified_at": "2024-01-15T10:00:00.000000Z",
     *   "created_at": "2024-01-15T10:00:00.000000Z",
     *   "updated_at": "2024-01-15T11:00:00.000000Z",
     *   "addresses": [
     *     {
     *       "id": 1,
     *       "user_id": 1,
     *       "label": "Home",
     *       "name": "John Doe Updated",
     *       "phone": "+201234567891",
     *       "address": "123 Main St, Cairo, Egypt",
     *       "city": "Cairo",
     *       "country": "Egypt",
     *       "is_default": true,
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "email": ["The email has already been taken."]
     *   }
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'sometimes|string|max:20',
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        // Hash password if provided
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        // Reload user with addresses
        $user->load(['addresses' => function ($query) {
            $query->orderBy('is_default', 'desc')->orderBy('created_at', 'desc');
        }]);

        return response()->json($user);
    }
}
