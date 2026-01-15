<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories with optional filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Category::query();

        // Search by name or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by active status
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        // Sort
        if ($request->has('sort_by')) {
            $sort = $request->sort_by;
            $direction = $request->get('sort_direction', 'asc');
            if (in_array($sort, ['name', 'created_at'])) {
                $query->orderBy($sort, $direction);
            }
        } else {
            $query->orderBy('name');
        }

        $categories = $query->paginate($request->get('per_page', 15));

        $enCategories = $categories->getCollection()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'name_ar' => $category->name_ar,
                'description' => $category->description,
                'description_ar' => $category->description_ar,
                'slug' => $category->slug,
                'is_active' => $category->is_active,
                'product_count' => $category->products()->count(),
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];
        });

        $arCategories = $categories->getCollection()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name_ar ?: $category->name,
                'name_ar' => $category->name_ar,
                'description' => $category->description_ar ?: $category->description,
                'description_ar' => $category->description_ar,
                'slug' => $category->slug,
                'is_active' => $category->is_active,
                'product_count' => $category->products()->count(),
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];
        });

        return response()->json([
            'data' => [
                'success' => true,
                'en' => $enCategories,
                'ar' => $arCategories,
                'pagination' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'per_page' => $categories->perPage(),
                    'total' => $categories->total(),
                ],
            ],
        ]);
    }

    /**
     * Get a single category
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $category->load(['products' => function ($query) {
                $query->where('is_active', true)->limit(10);
            }]),
        ]);
    }

    /**
     * Create a new category (Admin only)
     */
    public function store(Request $request): JsonResponse
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

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category->load('media'),
        ], 201);
    }

    /**
     * Update a category (Admin only)
     */
    public function update(Request $request, Category $category): JsonResponse
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

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category->load('media'),
        ]);
    }

    /**
     * Delete a category (Admin only)
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

    /**
     * Get all categories (Public API for testing)
     */
    public function publicIndex(Request $request): JsonResponse
    {
        $query = Category::query()->where('is_active', true);

        // Search by name or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort
        if ($request->has('sort_by')) {
            $sort = $request->sort_by;
            $direction = $request->get('sort_direction', 'asc');
            if (in_array($sort, ['name', 'created_at'])) {
                $query->orderBy($sort, $direction);
            }
        } else {
            $query->orderBy('name');
        }

        $categories = $query->paginate($request->get('per_page', 15));

        // Transform to separated language arrays for API testing
        $enCategories = [];
        $arCategories = [];

        $categories->getCollection()->each(function ($category) use (&$enCategories, &$arCategories) {
            $commonData = [
                'id' => $category->id,
                'slug' => $category->slug,
                'is_active' => $category->is_active,
                'product_count' => $category->products()->where('is_active', true)->count(),
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'image_url' => $category->getFirstMediaUrl('image'),

            ];

            $enCategories[] = array_merge($commonData, [
                'name' => $category->name,
                'description' => $category->description,
            ]);

            $arCategories[] = array_merge($commonData, [
                'name' => $category->name_ar,
                'description' => $category->description_ar,
            ]);
        });

        return response()->json([
            'success' => true,
            'data' => [
                'en' => $enCategories,
                'ar' => $arCategories,
            ],
            'pagination' => [
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'per_page' => $categories->perPage(),
                'total' => $categories->total(),
            ],
            'meta' => [
                'total_categories' => $categories->total(),
                'active_categories' => Category::where('is_active', true)->count(),
            ],
        ]);
    }

    /**
     * Get a single category (Public API for testing)
     */
    public function publicShow(Category $category): JsonResponse
    {
        if (! $category->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        // Get related products (limit for performance)
        $products = $category->products()
            ->where('is_active', true)
            ->with('media')
            ->limit(10)
            ->get()
            ->map(function ($product) {
                $commonProductData = [
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'price' => (float) $product->price,
                    'stock' => $product->stock,
                    'sku' => $product->sku,
                    'is_active' => $product->is_active,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                    'image_url' => $product->getFirstMediaUrl('images'),
                ];

                return [
                    'en' => array_merge($commonProductData, [
                        'name' => $product->name,
                    ]),
                    'ar' => array_merge($commonProductData, [
                        'name' => $product->name_ar,
                    ]),
                ];
            });

        $commonCategoryData = [
            'id' => $category->id,
            'slug' => $category->slug,
            'is_active' => $category->is_active,
            'product_count' => $category->products()->where('is_active', true)->count(),
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
            'image_url' => $category->getFirstMediaUrl('image'),
            'products' => $products,
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'en' => array_merge($commonCategoryData, [
                    'name' => $category->name,
                    'description' => $category->description,
                ]),
                'ar' => array_merge($commonCategoryData, [
                    'name' => $category->name_ar,
                    'description' => $category->description_ar,
                ]),
            ],
        ]);
    }
}
