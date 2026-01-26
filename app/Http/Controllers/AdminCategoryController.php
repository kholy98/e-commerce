<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminCategoryController extends Controller
{
    /**
     * Store a new category
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = Category::create($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))
                ->toMediaCollection('image');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Update a category
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'description' => 'sometimes|string',
            'description_ar' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        $category->update($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('image');
            $category->addMedia($request->file('image'))
                ->toMediaCollection('image');
        }

        // Handle image removal
        if ($request->boolean('remove_image')) {
            $category->clearMediaCollection('image');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
        // return RedirectResponse::class('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Delete a category
     */
    public function destroy(Category $category): JsonResponse
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category with existing products',
            ], 422);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ]);
    }
}
