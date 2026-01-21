<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Wishlist
 *
 * APIs for managing user wishlists.
 *
 * All endpoints in this group require authentication via Laravel Sanctum.
 * Users can save products to their wishlist for later purchase.
 */
class WishlistController extends Controller
{
    /**
     * List wishlist items
     *
     * Get all products in the authenticated user's wishlist.
     * Returns product data in both English and Arabic.
     *
     * @authenticated
     *
     * @response 200 scenario="Success" {
     *   "en": {
     *     "products": [
     *       {
     *         "id": 1,
     *         "name": "Premium Coffee Beans",
     *         "description": "High-quality arabica coffee beans",
     *         "wishlist_item_id": 5,
     *         "added_at": "2024-01-15T10:00:00.000000Z",
     *         "slug": "premium-coffee-beans",
     *         "price": 25.00,
     *         "cost": 15.00,
     *         "stock": 100,
     *         "sku": "COF-001",
     *         "is_active": true,
     *         "category_id": 1,
     *         "grind_type": "whole_bean",
     *         "weight": 0.5,
     *         "product_details": [
     *           {"title": "Origin", "value": "Ethiopia"},
     *           {"title": "Roast Level", "value": "Medium"}
     *         ],
     *         "image": "https://example.com/images/coffee.jpg",
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "count": 1
     *   },
     *   "ar": {
     *     "products": [
     *       {
     *         "id": 1,
     *         "name": "حبوب قهوة ممتازة",
     *         "description": "حبوب قهوة أرابيكا عالية الجودة",
     *         "wishlist_item_id": 5,
     *         "added_at": "2024-01-15T10:00:00.000000Z",
     *         "slug": "premium-coffee-beans",
     *         "price": 25.00,
     *         "cost": 15.00,
     *         "stock": 100,
     *         "sku": "COF-001",
     *         "is_active": true,
     *         "category_id": 1,
     *         "grind_type": "whole_bean",
     *         "weight": 0.5,
     *         "product_details": [
     *           {"title": "المنشأ", "value": "إثيوبيا"},
     *           {"title": "درجة التحميص", "value": "متوسط"}
     *         ],
     *         "image": "https://example.com/images/coffee.jpg",
     *         "created_at": "2024-01-15T10:00:00.000000Z",
     *         "updated_at": "2024-01-15T10:00:00.000000Z"
     *       }
     *     ],
     *     "count": 1
     *   }
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $wishlistItems = $request->user()
            ->wishlistItems()
            ->with('product')
            ->get();

        $enProducts = $wishlistItems->map(function ($wishlistItem) {
            return array_merge([
                'id' => $wishlistItem->product->id,
                'name' => $wishlistItem->product->name,
                'description' => $wishlistItem->product->description,
                'wishlist_item_id' => $wishlistItem->id,
                'added_at' => $wishlistItem->created_at,
            ], [
                'slug' => $wishlistItem->product->slug,
                'price' => (float) $wishlistItem->product->price,
                'cost' => (float) $wishlistItem->product->cost,
                'stock' => $wishlistItem->product->stock,
                'sku' => $wishlistItem->product->sku,
                'is_active' => $wishlistItem->product->is_active,
                'category_id' => $wishlistItem->product->category_id,
                'grind_type' => $wishlistItem->product->grind_type?->value,
                'weight' => (float) $wishlistItem->product->weight,
                'product_details' => $wishlistItem->product->product_details,
                'image' => $wishlistItem->product->getFirstMediaUrl('images'),
                'created_at' => $wishlistItem->product->created_at,
                'updated_at' => $wishlistItem->product->updated_at,
            ]);
        });

        $arProducts = $wishlistItems->map(function ($wishlistItem) {
            return array_merge([
                'id' => $wishlistItem->product->id,
                'name' => $wishlistItem->product->name_ar ?: $wishlistItem->product->name,
                'description' => $wishlistItem->product->description_ar ?: $wishlistItem->product->description,
                'wishlist_item_id' => $wishlistItem->id,
                'added_at' => $wishlistItem->created_at,
            ], [
                'slug' => $wishlistItem->product->slug,
                'price' => (float) $wishlistItem->product->price,
                'cost' => (float) $wishlistItem->product->cost,
                'stock' => $wishlistItem->product->stock,
                'sku' => $wishlistItem->product->sku,
                'is_active' => $wishlistItem->product->is_active,
                'category_id' => $wishlistItem->product->category_id,
                'grind_type' => $wishlistItem->product->grind_type?->value,
                'weight' => (float) $wishlistItem->product->weight,
                'product_details' => $wishlistItem->product->product_details,
                'image' => $wishlistItem->product->getFirstMediaUrl('images'),
                'created_at' => $wishlistItem->product->created_at,
                'updated_at' => $wishlistItem->product->updated_at,
            ]);
        });

        return response()->json([
            'en' => [
                'products' => $enProducts,
                'count' => $enProducts->count(),
            ],
            'ar' => [
                'products' => $arProducts,
                'count' => $arProducts->count(),
            ],
        ]);
    }

    /**
     * Add to wishlist
     *
     * Add a product to the authenticated user's wishlist.
     *
     * @authenticated
     *
     * @bodyParam product_id integer required The ID of the product to add. Example: 1
     *
     * @response 201 scenario="Success" {
     *   "message": "Product added to wishlist successfully",
     *   "data": {
     *     "id": 5,
     *     "product_id": 1,
     *     "created_at": "2024-01-15T10:00:00.000000Z"
     *   }
     * }
     * @response 422 scenario="Already in Wishlist" {
     *   "message": "Product is already in your wishlist"
     * }
     * @response 422 scenario="Product Unavailable" {
     *   "message": "Product is not available"
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = $request->user();
        $productId = $request->product_id;

        // Check if product exists and is active
        $product = Product::findOrFail($productId);
        if (! $product->is_active) {
            return response()->json([
                'message' => 'Product is not available',
            ], 422);
        }

        // Check if product is already in wishlist
        $existingWishlistItem = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingWishlistItem) {
            return response()->json([
                'message' => 'Product is already in your wishlist',
            ], 422);
        }

        // Add to wishlist
        $wishlistItem = Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json([
            'message' => 'Product added to wishlist successfully',
            'data' => [
                'id' => $wishlistItem->id,
                'product_id' => $wishlistItem->product_id,
                'created_at' => $wishlistItem->created_at,
            ],
        ], 201);
    }

    /**
     * Remove from wishlist
     *
     * Remove a product from the authenticated user's wishlist.
     *
     * @authenticated
     *
     * @urlParam productId integer required The product ID to remove. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "message": "Product removed from wishlist successfully"
     * }
     * @response 404 scenario="Not Found" {
     *   "message": "Product not found in your wishlist"
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(Request $request, int $productId): JsonResponse
    {
        $user = $request->user();

        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if (! $wishlistItem) {
            return response()->json([
                'message' => 'Product not found in your wishlist',
            ], 404);
        }

        $wishlistItem->delete();

        return response()->json([
            'message' => 'Product removed from wishlist successfully',
        ]);
    }

    /**
     * Check if in wishlist
     *
     * Check if a specific product is in the authenticated user's wishlist.
     *
     * @authenticated
     *
     * @urlParam productId integer required The product ID to check. Example: 1
     *
     * @response 200 scenario="In Wishlist" {
     *   "in_wishlist": true
     * }
     * @response 200 scenario="Not in Wishlist" {
     *   "in_wishlist": false
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function check(Request $request, int $productId): JsonResponse
    {
        $user = $request->user();

        $isInWishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json([
            'in_wishlist' => $isInWishlist,
        ]);
    }

    /**
     * Clear wishlist
     *
     * Remove all products from the authenticated user's wishlist.
     *
     * @authenticated
     *
     * @response 200 scenario="Success" {
     *   "message": "Wishlist cleared successfully",
     *   "deleted_count": 5
     * }
     * @response 401 scenario="Unauthenticated" {
     *   "message": "Unauthenticated."
     * }
     */
    public function clear(Request $request): JsonResponse
    {
        $user = $request->user();

        $deletedCount = $user->wishlistItems()->delete();

        return response()->json([
            'message' => 'Wishlist cleared successfully',
            'deleted_count' => $deletedCount,
        ]);
    }
}
