<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Weight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products with optional filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::query()->where('is_active', true);

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

        $products = $query->with('media')->paginate($request->get('per_page', 15));

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
     * Get a single product
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
                    //'grind_type' => $product->grind_type?->value,
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
}
