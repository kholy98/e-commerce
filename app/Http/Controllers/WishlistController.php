<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    /**
     * Display a listing of the user's wishlist items.
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
     * Add a product to the user's wishlist.
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
        if (!$product->is_active) {
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
     * Remove a product from the user's wishlist.
     */
    public function destroy(Request $request, int $productId): JsonResponse
    {
        $user = $request->user();

        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if (!$wishlistItem) {
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
     * Check if a product is in the user's wishlist.
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
     * Clear all items from the user's wishlist.
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
