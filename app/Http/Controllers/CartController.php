<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * Get the user's cart (stored in session)
     */
    public function index(Request $request): JsonResponse
    {
        $cart = $request->session()->get('cart', []);

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $cartItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $cartItems,
                'total' => round($total, 2),
                'item_count' => array_sum($cart),
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

        if (!$product->hasStock($validated['quantity'])) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock',
            ], 422);
        }

        $cart = $request->session()->get('cart', []);

        // If product already in cart, add to quantity
        if (isset($cart[$validated['product_id']])) {
            $newQuantity = $cart[$validated['product_id']] + $validated['quantity'];
            if (!$product->hasStock($newQuantity)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more, insufficient stock',
                ], 422);
            }
            $cart[$validated['product_id']] = $newQuantity;
        } else {
            $cart[$validated['product_id']] = $validated['quantity'];
        }

        $request->session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
            'data' => ['product_id' => $validated['product_id'], 'quantity' => $cart[$validated['product_id']]],
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

        $cart = $request->session()->get('cart', []);

        if ($validated['quantity'] === 0) {
            unset($cart[$productId]);
        } else {
            if (!$product->hasStock($validated['quantity'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock for this quantity',
                ], 422);
            }
            $cart[$productId] = $validated['quantity'];
        }

        $request->session()->put('cart', $cart);

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
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
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
        $request->session()->forget('cart');

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
        $cart = $request->session()->get('cart', []);

        $subtotal = 0;
        $itemCount = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal += $product->price * $quantity;
                $itemCount += $quantity;
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
