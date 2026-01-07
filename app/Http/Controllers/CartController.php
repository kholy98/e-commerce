<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Get the user's cart items
     */
    public function index(Request $request): JsonResponse
    {
        $cartItems = $request->user()->carts()->with('product.category')->get();

        $items = [];
        $total = 0;
        $itemCount = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product) {
                $subtotal = $cartItem->product->price * $cartItem->quantity;
                $items[] = [
                    'product_id' => $cartItem->product->id,
                    'product_name' => $cartItem->product->name,
                    'slug' => $cartItem->product->slug,
                    'description' => $cartItem->product->description,
                    'price' => $cartItem->product->price,
                    'sku' => $cartItem->product->sku,
                    'stock' => $cartItem->product->stock,
                    'is_active' => $cartItem->product->is_active,
                    'category' => $cartItem->product->category ? [
                        'id' => $cartItem->product->category->id,
                        'name' => $cartItem->product->category->name,
                        'slug' => $cartItem->product->category->slug,
                    ] : null,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
                $itemCount += $cartItem->quantity;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $items,
                'total' => round($total, 2),
                'item_count' => $itemCount,
            ],
        ]);
    }

    /**
     * Add item to cart
     */
    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);

        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Product is not available',
            ], 422);
        }

        $user = $request->user();

        // Check if product already in cart
        $existingCartItem = $user->carts()->where('product_id', $validated['product_id'])->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $validated['quantity'];
            if (!$product->hasStock($newQuantity)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more, insufficient stock',
                ], 422);
            }
            $existingCartItem->update(['quantity' => $newQuantity]);
        } else {
            if (!$product->hasStock($validated['quantity'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock',
                ], 422);
            }
            $user->carts()->create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
        ]);
    }

    /**
     * Update item quantity in cart
     */
    public function update(Request $request, $productId): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $user = $request->user();
        $cartItem = $user->carts()->where('product_id', $productId)->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item not in cart',
            ], 404);
        }

        if ($validated['quantity'] === 0) {
            $cartItem->delete();
        } else {
            if (!$product->hasStock($validated['quantity'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock for this quantity',
                ], 422);
            }
            $cartItem->update(['quantity' => $validated['quantity']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request, $productId): JsonResponse
    {
        $user = $request->user();
        $cartItem = $user->carts()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clear(Request $request): JsonResponse
    {
        $request->user()->carts()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
        ]);
    }

    /**
     * Get cart summary with totals
     */
    public function summary(Request $request): JsonResponse
    {
        $cartItems = $request->user()->carts()->with('product.category')->get();

        $subtotal = 0;
        $itemCount = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product) {
                $subtotal += $cartItem->product->price * $cartItem->quantity;
                $itemCount += $cartItem->quantity;
            }
        }

        $tax = round($subtotal * 0.1, 2);
        $shipping = $subtotal > 100 ? 0 : 10;
        $total = $subtotal + $tax + $shipping;

        return response()->json([
            'success' => true,
            'data' => [
                'subtotal' => round($subtotal, 2),
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => round($total, 2),
                'item_count' => $itemCount,
            ],
        ]);
    }
}
