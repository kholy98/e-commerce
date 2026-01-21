<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Categories
 *
 * APIs for browsing and managing product categories.
 *
 * Public endpoints for listing and viewing categories do not require authentication.
 * Admin endpoints for creating, updating, and deleting categories require authentication.
 */
class CategoryController extends Controller
{
    /**
     * List all categories (Admin)
     *
     * Get a paginated list of all categories with optional filtering and sorting.
     * This endpoint is intended for admin use and returns all categories including inactive ones.
     *
     * @authenticated
     *
     * @queryParam search string Search categories by name or description. Example: coffee
     * @queryParam is_active boolean Filter by active status. Example: true
     * @queryParam sort_by string Sort field (name, created_at). Example: name
     * @queryParam sort_direction string Sort direction (asc, desc). Default: asc. Example: desc
     * @queryParam per_page integer Number of items per page. Default: 15. Example: 10
     *
     * @response 200 scenario="Success" {
     *   "data": {
     *     "success": true,
     *     "en": [
     *       {
     *         "id": 1,
     *         "name": "Coffee Beans",
     *         "name_ar": "حبوب القهوة",
     *         "description": "Premium coffee beans from around the world",
     *         "description_ar": "حبوب قهوة ممتازة من جميع أنحاء العالم",
     *         "slug": "coffee-beans",
     *         "is_active": true,
     *         "product_count": 15,
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "ar": [
     *       {
     *         "id": 1,
     *         "name": "حبوب القهوة",
     *         "name_ar": "حبوب القهوة",
     *         "description": "حبوب قهوة ممتازة من جميع أنحاء العالم",
     *         "description_ar": "حبوب قهوة ممتازة من جميع أنحاء العالم",
     *         "slug": "coffee-beans",
     *         "is_active": true,
     *         "product_count": 15,
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "pagination": {
     *       "current_page": 1,
     *       "last_page": 3,
     *       "per_page": 15,
     *       "total": 45
     *     }
     *   }
     * }
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
     * Get category details (Admin)
     *
     * Retrieve detailed information about a specific category including related products.
     *
     * @authenticated
     *
     * @urlParam category integer required The category ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "name": "Coffee Beans",
     *     "name_ar": "حبوب القهوة",
     *     "description": "Premium coffee beans from around the world",
     *     "slug": "coffee-beans",
     *     "is_active": true,
     *     "products": [
     *       {
     *         "id": 1,
     *         "name": "Premium Coffee Beans",
     *         "slug": "premium-coffee-beans",
     *         "price": 25.00,
     *         "stock": 100,
     *         "is_active": true
     *       }
     *     ]
     *   }
     * }
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
     * Create category
     *
     * Create a new product category. Requires admin authentication.
     *
     * @authenticated
     *
     * @bodyParam name string required The category name in English. Example: Coffee Beans
     * @bodyParam name_ar string The category name in Arabic. Example: حبوب القهوة
     * @bodyParam description string The category description in English. Example: Premium coffee beans from around the world
     * @bodyParam description_ar string The category description in Arabic. Example: حبوب قهوة ممتازة من جميع أنحاء العالم
     * @bodyParam is_active boolean Whether the category is active. Default: true. Example: true
     * @bodyParam image file The category image (jpeg, png, jpg, gif, webp, max 2MB).
     *
     * @response 201 scenario="Success" {
     *   "success": true,
     *   "message": "Category created successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "Coffee Beans",
     *     "name_ar": "حبوب القهوة",
     *     "description": "Premium coffee beans from around the world",
     *     "slug": "coffee-beans",
     *     "is_active": true,
     *     "created_at": "2024-01-15T10:00:00.000000Z"
     *   }
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The name field is required.",
     *   "errors": {
     *     "name": ["The name field is required."]
     *   }
     * }
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
     * Update category
     *
     * Update an existing product category. Requires admin authentication.
     *
     * @authenticated
     *
     * @urlParam category integer required The category ID. Example: 1
     *
     * @bodyParam name string The category name in English. Example: Coffee Beans
     * @bodyParam name_ar string The category name in Arabic. Example: حبوب القهوة
     * @bodyParam description string The category description in English. Example: Premium coffee beans
     * @bodyParam description_ar string The category description in Arabic.
     * @bodyParam is_active boolean Whether the category is active. Example: true
     * @bodyParam image file The new category image (jpeg, png, jpg, gif, webp, max 2MB).
     * @bodyParam remove_image boolean Set to true to remove the current image. Example: false
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Category updated successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "Coffee Beans",
     *     "name_ar": "حبوب القهوة",
     *     "description": "Premium coffee beans",
     *     "slug": "coffee-beans",
     *     "is_active": true
     *   }
     * }
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
     * Delete category
     *
     * Delete a product category. Categories with existing products cannot be deleted.
     * Requires admin authentication.
     *
     * @authenticated
     *
     * @urlParam category integer required The category ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Category deleted successfully"
     * }
     * @response 422 scenario="Has Products" {
     *   "success": false,
     *   "message": "Cannot delete category with existing products"
     * }
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
     * List all categories
     *
     * Get a paginated list of all active categories with optional filtering and sorting.
     * Returns category data in both English and Arabic.
     *
     * @unauthenticated
     *
     * @queryParam search string Search categories by name or description. Example: coffee
     * @queryParam sort_by string Sort field (name, created_at). Example: name
     * @queryParam sort_direction string Sort direction (asc, desc). Default: asc. Example: desc
     * @queryParam per_page integer Number of items per page. Default: 15. Example: 10
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "en": [
     *       {
     *         "id": 1,
     *         "name": "Coffee Beans",
     *         "description": "Premium coffee beans from around the world",
     *         "slug": "coffee-beans",
     *         "is_active": true,
     *         "product_count": 15,
     *         "image_url": "https://example.com/images/coffee-beans.jpg"
     *       }
     *     ],
     *     "ar": [
     *       {
     *         "id": 1,
     *         "name": "حبوب القهوة",
     *         "description": "حبوب قهوة ممتازة من جميع أنحاء العالم",
     *         "slug": "coffee-beans",
     *         "is_active": true,
     *         "product_count": 15,
     *         "image_url": "https://example.com/images/coffee-beans.jpg"
     *       }
     *     ]
     *   },
     *   "pagination": {
     *     "current_page": 1,
     *     "last_page": 3,
     *     "per_page": 15,
     *     "total": 45
     *   },
     *   "meta": {
     *     "total_categories": 45,
     *     "active_categories": 42
     *   }
     * }
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
     * Get category details
     *
     * Retrieve detailed information about a specific active category including related products.
     * Returns data in both English and Arabic.
     *
     * @unauthenticated
     *
     * @urlParam category integer required The category ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "en": {
     *       "id": 1,
     *       "name": "Coffee Beans",
     *       "description": "Premium coffee beans from around the world",
     *       "slug": "coffee-beans",
     *       "is_active": true,
     *       "product_count": 15,
     *       "image_url": "https://example.com/images/coffee-beans.jpg",
     *       "products": [
     *         {
     *           "en": {
     *             "id": 1,
     *             "name": "Premium Coffee Beans",
     *             "slug": "premium-coffee-beans",
     *             "price": 25.00,
     *             "stock": 100,
     *             "sku": "COF-001",
     *             "is_active": true,
     *             "image_url": "https://example.com/images/product.jpg"
     *           },
     *           "ar": {
     *             "id": 1,
     *             "name": "حبوب قهوة ممتازة",
     *             "slug": "premium-coffee-beans",
     *             "price": 25.00,
     *             "stock": 100,
     *             "sku": "COF-001",
     *             "is_active": true,
     *             "image_url": "https://example.com/images/product.jpg"
     *           }
     *         }
     *       ]
     *     },
     *     "ar": {
     *       "id": 1,
     *       "name": "حبوب القهوة",
     *       "description": "حبوب قهوة ممتازة من جميع أنحاء العالم",
     *       "slug": "coffee-beans",
     *       "is_active": true,
     *       "product_count": 15,
     *       "image_url": "https://example.com/images/coffee-beans.jpg",
     *       "products": [
     *         {
     *           "en": {
     *             "id": 1,
     *             "name": "Premium Coffee Beans",
     *             "slug": "premium-coffee-beans",
     *             "price": 25.00,
     *             "stock": 100,
     *             "sku": "COF-001",
     *             "is_active": true,
     *             "image_url": "https://example.com/images/product.jpg"
     *           },
     *           "ar": {
     *             "id": 1,
     *             "name": "حبوب قهوة ممتازة",
     *             "slug": "premium-coffee-beans",
     *             "price": 25.00,
     *             "stock": 100,
     *             "sku": "COF-001",
     *             "is_active": true,
     *             "image_url": "https://example.com/images/product.jpg"
     *           }
     *         }
     *       ]
     *     }
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "success": false,
     *   "message": "Category not found"
     * }
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
