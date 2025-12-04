<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:100',
            'shipping_address' => 'required|array',
            'shipping_address.street' => 'required|string|max:255',
            'shipping_address.city' => 'required|string|max:100',
            'shipping_address.zip_code' => 'required|string|max:20',
            'shipping_address.country' => 'required|string|max:100',
            'notes' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'items.required' => 'Cart cannot be empty',
            'items.min' => 'Please add at least one item to your cart',
            'items.*.product_id.required' => 'Product ID is required for each item',
            'items.*.product_id.exists' => 'One or more products do not exist',
            'items.*.quantity.required' => 'Quantity is required for each item',
            'items.*.quantity.min' => 'Quantity must be at least 1',
            'shipping_address.required' => 'Shipping address is required',
            'shipping_address.street.required' => 'Street address is required',
            'shipping_address.city.required' => 'City is required',
            'shipping_address.zip_code.required' => 'ZIP code is required',
            'shipping_address.country.required' => 'Country is required',
        ];
    }
}
