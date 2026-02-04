<?php

namespace App\Http\Controllers;

use App\GrindType;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Weight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Products
 *
 * APIs for browsing and managing products.
 *
 * Public endpoints for listing and viewing products do not require authentication.
 * Admin endpoints for creating, updating, and deleting products require authentication.
 */
class ProductController extends Controller
{
    /**
     * List all products
     *
     * Get a paginated list of all active products with optional filtering, searching, and sorting.
     * Returns product data in both English and Arabic.
     *
     * @unauthenticated
     *
     * @operationId listPublicProducts
     *
     * @queryParam category_id integer Filter products by category ID. Example: 1
     * @queryParam search string Search products by name or description. Example: coffee
     * @queryParam sort_by string Sort field (price, name, created_at). Example: price
     * @queryParam sort_direction string Sort direction (asc, desc). Default: asc. Example: desc
     * @queryParam per_page integer Number of items per page. Default: 15. Example: 10
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "en": [
     *       {
     *         "id": 1,
     *         "name": "Premium Coffee Beans",
     *         "description": "High-quality arabica coffee beans",
     *         "price": 25.00,
     *         "cost": 15.00,
     *         "stock": 100,
     *         "sku": "COF-001",
     *         "category_id": 1,
     *         "is_active": true,
     *         "slug": "premium-coffee-beans",
     *         "grind_type": {"en": "Whole Bean", "ar": "حبوب كاملة"},
     *         "weight": 0.5,
     *         "weight_label": "500g",
     *         "product_details": [
     *           {"title": "Origin", "value": "Ethiopia"},
     *           {"title": "Roast Level", "value": "Medium"}
     *         ],
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z",
     *         "images": [
     *           {
     *             "id": 1,
     *             "name": "coffee-beans-front",
     *             "file_name": "coffee-beans-front.jpg",
     *             "mime_type": "image/jpeg",
     *             "size": 102400,
     *             "url": "https://example.com/storage/products/coffee-beans-front.jpg"
     *           }
     *         ]
     *       }
     *     ],
     *     "ar": [
     *       {
     *         "id": 1,
     *         "name": "حبوب قهوة ممتازة",
     *         "description": "حبوب قهوة أرابيكا عالية الجودة",
     *         "price": 25.00,
     *         "cost": 15.00,
     *         "stock": 100,
     *         "sku": "COF-001",
     *         "category_id": 1,
     *         "is_active": true,
     *         "slug": "premium-coffee-beans",
     *         "grind_type": {"en": "Whole Bean", "ar": "حبوب كاملة"},
     *         "weight": 0.5,
     *         "weight_label": "500g",
     *         "product_details": [
     *           {"title": "المنشأ", "value": "إثيوبيا"},
     *           {"title": "درجة التحميص", "value": "متوسط"}
     *         ],
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z",
     *         "images": [
     *           {
     *             "id": 1,
     *             "name": "coffee-beans-front",
     *             "file_name": "coffee-beans-front.jpg",
     *             "mime_type": "image/jpeg",
     *             "size": 102400,
     *             "url": "https://example.com/storage/products/coffee-beans-front.jpg"
     *           }
     *         ]
     *       }
     *     ],
     *     "pagination": {
     *       "current_page": 1,
     *       "last_page": 5,
     *       "per_page": 15,
     *       "total": 75
     *     }
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();

        // Only enforce active status for non-admin routes
        if (! $request->is('api/admin/*')) {
            $query->where('is_active', true);
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search by name or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort by price
        if ($request->has('sort_by')) {
            $sort = $request->sort_by;
            $direction = $request->get('sort_direction', 'asc');
            if (in_array($sort, ['price', 'name', 'created_at'])) {
                $query->orderBy($sort, $direction);
            }
        }

        $products = $query->with(['media', 'category'])->paginate($request->get('per_page', 15));

        $enProducts = $products->getCollection()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => (float) $product->price,
                'cost' => (float) $product->cost,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'category_id' => $product->category_id,
                'category' => $product->category ? [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'slug' => $product->category->slug,
                ] : null,
                'is_active' => $product->is_active,
                'slug' => $product->slug,
                'grind_type' => $product->grind_type ? [
                    'en' => $product->grind_type->label(),
                    'ar' => $product->grind_type->labelAr(),
                ] : null,
                'weight' => (float) $product->weight,
                'weight_label' => Weight::fromKg((float) $product->weight)?->label(),
                'product_details' => collect($product->product_details ?? [])->map(function ($detail) {
                    return [
                        'title' => $detail['title_en'] ?? '',
                        'value' => $detail['value_en'] ?? '',
                    ];
                })->toArray(),
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
                'images' => $product->getMedia('images')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'name' => $media->name,
                        'file_name' => $media->file_name,
                        'mime_type' => $media->mime_type,
                        'size' => $media->size,
                        'url' => $media->getUrl(),

                    ];
                }),

            ];
        });

        $arProducts = $products->getCollection()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name_ar ?: $product->name,
                'description' => $product->description_ar ?: $product->description,
                'price' => (float) $product->price,
                'cost' => (float) $product->cost,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'category_id' => $product->category_id,
                'category' => $product->category ? [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'slug' => $product->category->slug,
                ] : null,
                'is_active' => $product->is_active,
                'slug' => $product->slug,
                'grind_type' => $product->grind_type ? [
                    'en' => $product->grind_type->label(),
                    'ar' => $product->grind_type->labelAr(),
                ] : null,
                'weight' => (float) $product->weight,
                'weight_label' => Weight::fromKg((float) $product->weight)?->label(),
                'product_details' => collect($product->product_details ?? [])->map(function ($detail) {
                    return [
                        'title' => $detail['title_ar'] ?? '',
                        'value' => $detail['value_ar'] ?? '',
                    ];
                })->toArray(),
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
                'images' => $product->getMedia('images')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'name' => $media->name,
                        'file_name' => $media->file_name,
                        'mime_type' => $media->mime_type,
                        'size' => $media->size,
                        'url' => $media->getUrl(),

                    ];
                }),

            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'en' => $enProducts,
                'ar' => $arProducts,
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ],
            ],
        ]);
    }

    /**
     * List all products (Admin)
     *
     * Get a paginated list of all products (including inactive) for admin management.
     * Same as public endpoint but shows all products regardless of active status.
     *
     * @authenticated
     *
     * @operationId listAdminProducts
     *
     * @queryParam category_id integer Filter products by category ID. Example: 1
     * @queryParam search string Search products by name or description. Example: coffee
     * @queryParam sort_by string Sort field (price, name, created_at). Example: price
     * @queryParam sort_direction string Sort direction (asc, desc). Default: asc. Example: desc
     * @queryParam per_page integer Number of items per page. Default: 15. Example: 10
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "en": [
     *       {
     *         "id": 1,
     *         "name": "Premium Coffee Beans",
     *         "description": "High-quality arabica coffee beans",
     *         "price": 25.00,
     *         "cost": 15.00,
     *         "stock": 100,
     *         "sku": "COF-001",
     *         "category_id": 1,
     *         "is_active": true,
     *         "slug": "premium-coffee-beans",
     *         "grind_type": {"en": "Whole Bean", "ar": "حبوب كاملة"},
     *         "weight": 0.5,
     *         "weight_label": "500g",
     *         "product_details": [
     *           {"title": "Origin", "value": "Ethiopia"},
     *           {"title": "Roast Level", "value": "Medium"}
     *         ],
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z",
     *         "images": [
     *           {
     *             "id": 1,
     *             "name": "coffee-beans-front",
     *             "file_name": "coffee-beans-front.jpg",
     *             "mime_type": "image/jpeg",
     *             "size": 102400,
     *             "url": "https://example.com/storage/products/coffee-beans-front.jpg"
     *           }
     *         ]
     *       }
     *     ],
     *     "ar": [
     *       {
     *         "id": 1,
     *         "name": "حبوب قهوة ممتازة",
     *         "description": "حبوب قهوة أرابيكا عالية الجودة",
     *         "price": 25.00,
     *         "cost": 15.00,
     *         "stock": 100,
     *         "sku": "COF-001",
     *         "category_id": 1,
     *         "is_active": true,
     *         "slug": "premium-coffee-beans",
     *         "grind_type": {"en": "Whole Bean", "ar": "حبوب كاملة"},
     *         "weight": 0.5,
     *         "weight_label": "500g",
     *         "product_details": [
     *           {"title": "المنشأ", "value": "إثيوبيا"},
     *           {"title": "درجة التحميص", "value": "متوسط"}
     *         ],
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z",
     *         "images": [
     *           {
     *             "id": 1,
     *             "name": "coffee-beans-front",
     *             "file_name": "coffee-beans-front.jpg",
     *             "mime_type": "image/jpeg",
     *             "size": 102400,
     *             "url": "https://example.com/storage/products/coffee-beans-front.jpg"
     *           }
     *         ]
     *       }
     *     ],
     *     "pagination": {
     *       "current_page": 1,
     *       "last_page": 5,
     *       "per_page": 15,
     *       "total": 75
     *     }
     *   }
     * }
     */
    public function indexAdmin(Request $request): JsonResponse
    {
        // Reuse the same logic as index() but without the active filter
        return $this->index($request);
    }

    /**
     * Get product details
     *
     * Retrieve detailed information about a specific product.
     * Returns product data in both English and Arabic.
     *
     * @unauthenticated
     *
     * @urlParam product integer required The product ID. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "en": {
     *       "id": 1,
     *       "name": "Premium Coffee Beans",
     *       "description": "High-quality arabica coffee beans",
     *       "price": 25.00,
     *       "cost": 15.00,
     *       "stock": 100,
     *       "sku": "COF-001",
     *       "category_id": 1,
     *       "is_active": true,
     *       "grind_type": "whole_bean",
     *       "grind_type_label": "Whole Bean",
     *       "weight": 0.5,
     *       "weight_label": "500g",
     *       "product_details": [
     *         {"title": "Origin", "value": "Ethiopia"},
     *         {"title": "Roast Level", "value": "Medium"}
     *       ],
     *       "category": {
     *         "id": 1,
     *         "name": "Coffee Beans",
     *         "slug": "coffee-beans"
     *       },
     *       "images": [
     *         {
     *           "id": 1,
     *           "name": "coffee-beans-front",
     *           "file_name": "coffee-beans-front.jpg",
     *           "mime_type": "image/jpeg",
     *           "size": 102400,
     *           "url": "https://example.com/storage/products/coffee-beans-front.jpg"
     *         }
     *       ],
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     },
     *     "ar": {
     *       "id": 1,
     *       "name": "حبوب قهوة ممتازة",
     *       "description": "حبوب قهوة أرابيكا عالية الجودة",
     *       "price": 25.00,
     *       "cost": 15.00,
     *       "stock": 100,
     *       "sku": "COF-001",
     *       "category_id": 1,
     *       "is_active": true,
     *       "grind_type_label": "حبوب كاملة",
     *       "weight": 0.5,
     *       "weight_label": "500g",
     *       "product_details": [
     *         {"title": "المنشأ", "value": "إثيوبيا"},
     *         {"title": "درجة التحميص", "value": "متوسط"}
     *       ],
     *       "category": {
     *         "id": 1,
     *         "name": "حبوب القهوة",
     *         "slug": "coffee-beans"
     *       },
     *       "images": [
     *         {
     *           "id": 1,
     *           "name": "coffee-beans-front",
     *           "file_name": "coffee-beans-front.jpg",
     *           "mime_type": "image/jpeg",
     *           "size": 102400,
     *           "url": "https://example.com/storage/products/coffee-beans-front.jpg"
     *         }
     *       ],
     *       "created_at": "2024-01-15T10:00:00.000000Z",
     *       "updated_at": "2024-01-15T10:00:00.000000Z"
     *     }
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "success": false,
     *   "message": "Product not found"
     * }
     */
    public function show(Product $product): JsonResponse
    {
        if (! $product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $product->load(['category', 'media']);

        return response()->json([
            'success' => true,
            'data' => [
                'en' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => (float) $product->price,
                    'cost' => (float) $product->cost,
                    'stock' => $product->stock,
                    'sku' => $product->sku,
                    'category_id' => $product->category_id,
                    'is_active' => $product->is_active,
                    'grind_type' => $product->grind_type?->value,
                    'grind_type_label' => $product->grind_type?->label(),
                    'weight' => (float) $product->weight,
                    'weight_label' => Weight::fromKg((float) $product->weight)?->label(),
                    'product_details' => collect($product->product_details ?? [])->map(function ($detail) {
                        return [
                            'title' => $detail['title_en'] ?? '',
                            'value' => $detail['value_en'] ?? '',
                        ];
                    })->toArray(),
                    'category' => new CategoryResource($product->category),
                    'images' => $product->media->map(function ($media) {
                        return [
                            'id' => $media->id,
                            'name' => $media->name,
                            'file_name' => $media->file_name,
                            'mime_type' => $media->mime_type,
                            'size' => $media->size,
                            'url' => $media->getUrl(),
                        ];
                    }),
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ],
                'ar' => [
                    'id' => $product->id,
                    'name' => $product->name_ar ?: $product->name,
                    'description' => $product->description_ar ?: $product->description,
                    'price' => (float) $product->price,
                    'cost' => (float) $product->cost,
                    'stock' => $product->stock,
                    'sku' => $product->sku,
                    'category_id' => $product->category_id,
                    'is_active' => $product->is_active,
                    // 'grind_type' => $product->grind_type?->value,
                    'grind_type_label' => $product->grind_type?->labelAr(),
                    'weight' => (float) $product->weight,
                    'weight_label' => Weight::fromKg((float) $product->weight)?->label(),
                    'product_details' => collect($product->product_details ?? [])->map(function ($detail) {
                        return [
                            'title' => $detail['title_ar'] ?? '',
                            'value' => $detail['value_ar'] ?? '',
                        ];
                    })->toArray(),
                    'category' => new CategoryResource($product->category),
                    'images' => $product->media->map(function ($media) {
                        return [
                            'id' => $media->id,
                            'name' => $media->name,
                            'file_name' => $media->file_name,
                            'mime_type' => $media->mime_type,
                            'size' => $media->size,
                            'url' => $media->getUrl(),
                        ];
                    }),
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ],
            ],
        ]);
    }

    /**
     * Create a new product (Admin only)
     */
    public function store(Request $request): JsonResponse
    {
        $grindTypes = collect(GrindType::cases())->map(fn ($case) => $case->value)->toArray();
        $weights = collect(Weight::cases())->map(fn ($case) => $case->toKg())->toArray();

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
            'grind_type' => 'nullable|string|in:'.implode(',', $grindTypes),
            'weight' => 'nullable|numeric|in:'.implode(',', $weights),
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

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => new ProductResource($product->load(['category', 'media'])),
        ], 201);
    }

    /**
     * Update a product (Admin only)
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        \Log::info('Product update request received', [
            'product_id' => $product->id,
            'request_data' => $request->all(),
            'has_files' => $request->hasFile('images'),
            'files' => $request->allFiles(),
        ]);

        $grindTypes = collect(GrindType::cases())->map(fn ($case) => $case->value)->toArray();
        $weights = collect(Weight::cases())->map(fn ($case) => $case->toKg())->toArray();

        try {
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
                'grind_type' => 'nullable|string|in:'.implode(',', $grindTypes),
                'weight' => 'nullable|numeric|in:'.implode(',', $weights),
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

            \Log::info('Validation passed', ['validated_data' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all(),
            ]);
            throw $e;
        }

        $product->update($validated);

        // Handle image management
        \Log::info('Product update - Image management', [
            'product_id' => $product->id,
            'has_remove_images' => $request->has('remove_images'),
            'remove_images' => $request->get('remove_images', []),
            'has_images' => $request->hasFile('images'),
            'images_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
            'existing_media_count' => $product->getMedia('images')->count(),
        ]);

        // Remove specific images if requested
        if ($request->has('remove_images')) {
            $removeImageIds = $request->get('remove_images', []);
            \Log::info('Removing images', ['ids' => $removeImageIds]);

            foreach ($removeImageIds as $mediaId) {
                $media = $product->getMedia('images')->find($mediaId);
                if ($media) {
                    \Log::info('Deleting media', ['id' => $mediaId, 'name' => $media->name]);
                    $media->delete();
                } else {
                    \Log::warning('Media not found for deletion', ['id' => $mediaId]);
                }
            }
        }

        // Add new images (always keep existing images unless explicitly removed)
        if ($request->hasFile('images')) {
            \Log::info('Adding new images', ['count' => count($request->file('images'))]);

            foreach ($request->file('images') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('images');
                \Log::info('Added media', ['filename' => $image->getClientOriginalName()]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => new ProductResource($product->load(['category', 'media'])),
        ]);
    }

    /**
     * Delete a product (Admin only)
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }

    /**
     * Get low stock products (Admin only)
     */
    public function lowStock(): JsonResponse
    {
        $products = Product::where('stock', '<', 10)
            ->where('is_active', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Get all categories
     */
    public function categories(): JsonResponse
    {
        $categories = Category::where('is_active', true)->get();

        $enCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'slug' => $category->slug,
                'is_active' => $category->is_active,
                'sort_order' => $category->sort_order,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];
        });

        $arCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name_ar ?: $category->name,
                'description' => $category->description_ar ?: $category->description,
                'slug' => $category->slug,
                'is_active' => $category->is_active,
                'sort_order' => $category->sort_order,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];
        });

        return response()->json([
            'data' => [
                'success' => true,
                'en' => $enCategories,
                'ar' => $arCategories,
            ],
        ]);
    }

    /**
     * Get product by category, weight, and grind type
     */
    public function getBySpecifications(Request $request): JsonResponse
    {
        $categoryNames = Category::where('is_active', true)->pluck('name')->toArray();
        $categorySlugs = Category::where('is_active', true)->pluck('slug')->toArray();
        $categoryNamesAr = Category::where('is_active', true)->pluck('name_ar')->filter()->toArray();
        $validCategories = array_merge($categoryNames, $categorySlugs, $categoryNamesAr);

        $grindTypes = collect(GrindType::cases())->map(fn ($case) => $case->value)->toArray();

        $validator = Validator::make($request->all(), [
            'category' => ['required', 'string', 'in:'.implode(',', $validCategories)],
            'weight' => 'required|numeric|min:0.001',
            'grind_type' => ['required', 'string', 'in:'.implode(',', $grindTypes)],
        ], [
            'category.in' => 'Invalid category. Valid categories are: '.implode(', ', $categoryNames),
            'grind_type.in' => 'Invalid grind type. Valid types are: '.implode(', ', $grindTypes),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $weightKg = (float) $validated['weight'];
        $grindType = $validated['grind_type'];

        $product = Product::with(['category', 'media'])
            ->whereHas('category', function ($query) use ($validated) {
                $query->where('name', $validated['category'])
                    ->orWhere('slug', $validated['category'])
                    ->orWhere('name_ar', $validated['category']);
            })
            ->where('weight', $weightKg)
            ->where('grind_type', $grindType)
            ->where('is_active', true)
            ->first();

        if (! $product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found with these specifications',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'en' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'description' => $product->description,
                    'price' => (float) $product->price,
                    'cost' => (float) $product->cost,
                    'stock' => (float) $product->stock,
                    'sku' => $product->sku,
                    'is_active' => $product->is_active,
                    'grind_type' => $product->grind_type?->value,
                    'grind_type_label' => $product->grind_type?->label(),
                    'weight' => (float) $product->weight,
                    'weight_label' => Weight::fromKg((float) $product->weight)?->label(),
                    'category' => [
                        'name' => $product->category?->name,
                        'slug' => $product->category?->slug,
                    ],
                    'images' => $product->getMedia('images')->map(function ($media) {
                        return ['url' => $media->getUrl()];
                    }),
                ],
                'ar' => [
                    'id' => $product->id,
                    'name' => $product->name_ar ?: $product->name,
                    'slug' => $product->slug,
                    'description' => $product->description_ar ?: $product->description,
                    'price' => (float) $product->price,
                    'cost' => (float) $product->cost,
                    'stock' => (float) $product->stock,
                    'sku' => $product->sku,
                    'is_active' => $product->is_active,
                    'grind_type' => $product->grind_type?->value,
                    'grind_type_label' => $product->grind_type?->labelAr(),
                    'weight' => (float) $product->weight,
                    'weight_label' => Weight::fromKg((float) $product->weight)?->label(),
                    'category' => [
                        'name' => $product->category?->name_ar ?: $product->category?->name,
                        'slug' => $product->category?->slug,
                    ],
                    'images' => $product->getMedia('images')->map(function ($media) {
                        return ['url' => $media->getUrl()];
                    }),
                ],
            ],
        ]);
    }
}
