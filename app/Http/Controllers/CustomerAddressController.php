<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Customer Addresses
 *
 * APIs for managing customer addresses.
 * All endpoints require authentication.
 */
class CustomerAddressController extends Controller
{
    /**
     * List all customer addresses
     *
     * Get a paginated list of all addresses for the authenticated user.
     * Addresses are ordered by default status (default first) then by creation date.
     *
     * @authenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "user_id": 1,
     *       "label": "Home",
     *       "name": "John Doe",
     *       "phone": "+201234567890",
     *       "address": "123 Main St, Cairo, Egypt",
     *       "street": "123 Main St",
     *       "building_number": "15",
     *       "floor": "3",
     *       "apartment": "5A",
     *       "zone": "Maadi",
     *       "city": "Cairo",
     *       "zip_code": "12345",
     *       "country": "Egypt",
     *       "state": "Cairo Governorate",
     *       "is_default": true,
     *       "is_billing": true,
     *       "is_shipping": true,
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "user_id": 1,
     *       "label": "Work",
     *       "name": "John Doe",
     *       "phone": "+201234567891",
     *       "address": "456 Business Ave, Cairo, Egypt",
     *       "street": "456 Business Ave",
     *       "building_number": "20",
     *       "floor": "5",
     *       "apartment": "10B",
     *       "zone": "New Cairo",
     *       "city": "Cairo",
     *       "zip_code": "12346",
     *       "country": "Egypt",
     *       "state": "Cairo Governorate",
     *       "is_default": false,
     *       "is_billing": false,
     *       "is_shipping": true,
     *       "created_at": "2024-01-16T10:00:00.000000Z",
     *       "updated_at": "2024-01-16T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $addresses = Auth::user()->addresses()
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $addresses,
        ]);
    }

    /**
     * Create a new customer address
     *
     * Create a new address for the authenticated user.
     * If is_default is set to true, all other addresses will be unset as default.
     *
     * @authenticated
     *
     * @bodyParam label string optional A custom label for the address (e.g., "Home", "Work"). Example: Home
     * @bodyParam name string required The full name of the recipient. Example: John Doe
     * @bodyParam phone string required The phone number. Example: +201234567890
     * @bodyParam address string required The full address text. Example: 123 Main St, Cairo, Egypt
     * @bodyParam street string optional The street name. Example: 123 Main St
     * @bodyParam building_number string optional The building number. Example: 15
     * @bodyParam floor string optional The floor number. Example: 3
     * @bodyParam apartment string optional The apartment number. Example: 5A
     * @bodyParam zone string optional The zone/area. Example: Maadi
     * @bodyParam city string required The city name. Example: Cairo
     * @bodyParam zip_code string required The postal/ZIP code. Example: 12345
     * @bodyParam country string required The country name. Example: Egypt
     * @bodyParam state string optional The state/province. Example: Cairo Governorate
     * @bodyParam is_default boolean optional Whether this should be the default address. Default: false. Example: true
     * @bodyParam is_billing boolean optional Whether this can be used for billing. Default: false. Example: true
     * @bodyParam is_shipping boolean optional Whether this can be used for shipping. Default: false. Example: true
     *
     * @response 201 scenario="Success" {
     *   "success": true,
     *   "message": "Address created successfully",
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "label": "Home",
     *     "name": "John Doe",
     *     "phone": "+201234567890",
     *     "address": "123 Main St, Cairo, Egypt",
     *     "street": "123 Main St",
     *     "building_number": "15",
     *     "floor": "3",
     *     "apartment": "5A",
     *     "zone": "Maadi",
     *     "city": "Cairo",
     *     "zip_code": "12345",
     *     "country": "Egypt",
     *     "state": "Cairo Governorate",
     *     "is_default": true,
     *     "is_billing": true,
     *     "is_shipping": true,
     *     "created_at": "2024-01-15T10:00:00.000000Z",
     *     "updated_at": "2024-01-15T10:00:00.000000Z"
     *   }
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": ["The name field is required."],
     *     "city": ["The city field is required."]
     *   }
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => 'nullable|string|max:255',
            'name' => 'string|max:255',
            'phone' => 'string|max:20',
            'address' => 'string',
            'street' => 'nullable|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'zone' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'is_default' => 'boolean',
            'is_billing' => 'boolean',
            'is_shipping' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();

        // If this is set as default, unset other defaults
        if ($validated['is_default'] ?? false) {
            CustomerAddress::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        $address = CustomerAddress::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Address created successfully',
            'data' => $address,
        ], 201);
    }

    /**
     * Get a specific customer address
     *
     * Retrieve details of a specific address belonging to the authenticated user.
     *
     * @authenticated
     *
     * @urlParam address integer required The address ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "label": "Home",
     *     "name": "John Doe",
     *     "phone": "+201234567890",
     *     "address": "123 Main St, Cairo, Egypt",
     *     "street": "123 Main St",
     *     "building_number": "15",
     *     "floor": "3",
     *     "apartment": "5A",
     *     "zone": "Maadi",
     *     "city": "Cairo",
     *     "zip_code": "12345",
     *     "country": "Egypt",
     *     "state": "Cairo Governorate",
     *     "is_default": true,
     *     "is_billing": true,
     *     "is_shipping": true,
     *     "created_at": "2024-01-15T10:00:00.000000Z",
     *     "updated_at": "2024-01-15T10:00:00.000000Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "success": false,
     *   "message": "Address not found"
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function show(CustomerAddress $address): JsonResponse
    {
        // Ensure user owns this address
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $address,
        ]);
    }

    /**
     * Update a customer address
     *
     * Update an existing address belonging to the authenticated user.
     * If is_default is set to true, all other addresses will be unset as default.
     *
     * @authenticated
     *
     * @urlParam address integer required The address ID. Example: 1
     *
     * @bodyParam label string optional A custom label for the address (e.g., "Home", "Work"). Example: Home
     * @bodyParam name string required The full name of the recipient. Example: John Doe
     * @bodyParam phone string required The phone number. Example: +201234567890
     * @bodyParam address string required The full address text. Example: 123 Main St, Cairo, Egypt
     * @bodyParam street string optional The street name. Example: 123 Main St
     * @bodyParam building_number string optional The building number. Example: 15
     * @bodyParam floor string optional The floor number. Example: 3
     * @bodyParam apartment string optional The apartment number. Example: 5A
     * @bodyParam zone string optional The zone/area. Example: Maadi
     * @bodyParam city string required The city name. Example: Cairo
     * @bodyParam zip_code string required The postal/ZIP code. Example: 12345
     * @bodyParam country string required The country name. Example: Egypt
     * @bodyParam state string optional The state/province. Example: Cairo Governorate
     * @bodyParam is_default boolean optional Whether this should be the default address. Example: true
     * @bodyParam is_billing boolean optional Whether this can be used for billing. Example: true
     * @bodyParam is_shipping boolean optional Whether this can be used for shipping. Example: true
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Address updated successfully",
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "label": "Home Updated",
     *     "name": "John Doe",
     *     "phone": "+201234567890",
     *     "address": "123 Main St, Cairo, Egypt",
     *     "street": "123 Main St",
     *     "building_number": "15",
     *     "floor": "3",
     *     "apartment": "5A",
     *     "zone": "Maadi",
     *     "city": "Cairo",
     *     "zip_code": "12345",
     *     "country": "Egypt",
     *     "state": "Cairo Governorate",
     *     "is_default": true,
     *     "is_billing": true,
     *     "is_shipping": true,
     *     "created_at": "2024-01-15T10:00:00.000000Z",
     *     "updated_at": "2024-01-15T11:00:00.000000Z"
     *   }
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": ["The name field is required."]
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "success": false,
     *   "message": "Address not found"
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function update(Request $request, CustomerAddress $address): JsonResponse
    {

        // Ensure user owns this address
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        $validated = $request->validate([
            'label' => 'nullable|string|max:255',
            'name' => 'string|max:255',
            'phone' => 'string|max:20',
            'address' => 'string',
            'street' => 'nullable|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'zone' => 'nullable|string|max:255',
            'city' => 'string|max:255',
            'zip_code' => 'string|max:20',
            'country' => 'string|max:255',
            'state' => 'nullable|string|max:255',
            'is_default' => 'boolean',
            'is_billing' => 'boolean',
            'is_shipping' => 'boolean',
        ]);

        // If this is set as default, unset other defaults
        if ($validated['is_default'] ?? false) {
            CustomerAddress::where('user_id', Auth::id())
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        }

        $address->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully',
            'data' => $address,
        ]);
    }

    /**
     * Delete a customer address
     *
     * Delete an existing address belonging to the authenticated user.
     *
     * @authenticated
     *
     * @urlParam address integer required The address ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Address deleted successfully"
     * }
     * @response 404 scenario="Not Found" {
     *   "success": false,
     *   "message": "Address not found"
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(CustomerAddress $address): JsonResponse
    {
        // Ensure user owns this address
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully',
        ]);
    }

    /**
     * Set address as default
     *
     * Set a specific address as the default address for the authenticated user.
     * All other addresses will be unset as default.
     *
     * @authenticated
     *
     * @urlParam address integer required The address ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Address set as default successfully",
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "label": "Home",
     *     "name": "John Doe",
     *     "phone": "+201234567890",
     *     "address": "123 Main St, Cairo, Egypt",
     *     "street": "123 Main St",
     *     "building_number": "15",
     *     "floor": "3",
     *     "apartment": "5A",
     *     "zone": "Maadi",
     *     "city": "Cairo",
     *     "zip_code": "12345",
     *     "country": "Egypt",
     *     "state": "Cairo Governorate",
     *     "is_default": true,
     *     "is_billing": true,
     *     "is_shipping": true,
     *     "created_at": "2024-01-15T10:00:00.000000Z",
     *     "updated_at": "2024-01-15T11:00:00.000000Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "success": false,
     *   "message": "Address not found"
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function setDefault(CustomerAddress $address): JsonResponse
    {
        // Ensure user owns this address
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        $address->setAsDefault();

        return response()->json([
            'success' => true,
            'message' => 'Address set as default successfully',
            'data' => $address,
        ]);
    }
}
