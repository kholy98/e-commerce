<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Store a new product
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_ar' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'cost' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'grind_type' => 'nullable|in:whole_bean,coarse,medium,fine,extra_fine',
            'weight' => 'nullable|numeric|in:0.125,0.250,0.500,1.000',
            'product_details' => 'nullable|array',
            'product_details.*.title_en' => 'required|string|max:255',
            'product_details.*.title_ar' => 'required|string|max:255',
            'product_details.*.value_en' => 'required|string|max:1000',
            'product_details.*.value_ar' => 'required|string|max:1000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $product = Product::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Update a product
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'description' => 'sometimes|string',
            'description_ar' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0.01',
            'cost' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'sku' => 'sometimes|string|unique:products,sku,'.$product->id,
            'category_id' => 'sometimes|exists:categories,id',
            'is_active' => 'sometimes|boolean',
            'grind_type' => 'nullable|in:whole_bean,coarse,medium,fine,extra_fine',
            'weight' => 'sometimes|numeric|in:0.125,0.250,0.500,1.000',
            'product_details' => 'nullable|array',
            'product_details.*.title_en' => 'required|string|max:255',
            'product_details.*.title_ar' => 'required|string|max:255',
            'product_details.*.value_en' => 'required|string|max:1000',
            'product_details.*.value_ar' => 'required|string|max:1000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer',
        ]);

        $product->update($validated);

        // Handle image management
        // Remove specific images if requested
        if ($request->has('remove_images')) {
            $removeImageIds = $request->get('remove_images', []);

            foreach ($removeImageIds as $mediaId) {
                $media = $product->getMedia('images')->find($mediaId);
                if ($media) {
                    $media->delete();
                }
            }
        }

        // Add new images (always keep existing images unless explicitly removed)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Delete a product
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }
}
