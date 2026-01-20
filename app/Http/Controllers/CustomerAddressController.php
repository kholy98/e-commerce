<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the user's addresses.
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
     * Store a newly created address.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
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
     * Display the specified address.
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
     * Update the specified address.
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
     * Remove the specified address.
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
     * Set an address as default.
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
