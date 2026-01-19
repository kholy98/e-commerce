<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\SessionCartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected SessionCartService $cartService;

    public function __construct(SessionCartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Get the user's cart items (supports both guest and authenticated users)
     */
    public function index(Request $request): JsonResponse
    {
        $items = $this->cartService->getFormattedItems();
        $summary = $this->cartService->getSummary();

        return response()->json([
            'success' => true,
            'data' => [
                'en' => [
                    'items' => $items['en']['items'],
                    'count' => $items['en']['count'],
                    'summary' => $summary,
                ],
                'ar' => [
                    'items' => $items['ar']['items'],
                    'count' => $items['ar']['count'],
                    'summary' => $summary,
                ],
                'is_guest' => !Auth::check(),
            ],
        ]);
    }

    /**
     * Add item to cart (supports both guest and authenticated users)
     */
    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $this->cartService->addItem(
                $validated['product_id'],
                $validated['quantity']
            );

            return response()->json([
                'success' => true,
                'message' => 'Item added to cart',
                'cart_summary' => $this->cartService->getSummary(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Update item quantity in cart (supports both guest and authenticated users)
     */
    public function update(Request $request, $productId): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        try {
            $this->cartService->updateItem(
                intval($productId),
                $validated['quantity']
            );

            return response()->json([
                'success' => true,
                'message' => 'Cart updated',
                'cart_summary' => $this->cartService->getSummary(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getMessage() === 'Product not found' ? 404 : 422);
        }
    }

    /**
     * Remove item from cart (supports both guest and authenticated users)
     */
    public function remove(Request $request, $productId): JsonResponse
    {
        $this->cartService->removeItem(intval($productId));

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_summary' => $this->cartService->getSummary(),
        ]);
    }

    /**
     * Clear entire cart (supports both guest and authenticated users)
     */
    public function clear(Request $request): JsonResponse
    {
        $this->cartService->clearCart();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
        ]);
    }

    /**
     * Get cart summary with totals (supports both guest and authenticated users)
     */
    public function summary(Request $request): JsonResponse
    {
        $summary = $this->cartService->getSummary();

        return response()->json([
            'success' => true,
            'data' => $summary,
        ]);
    }

    /**
     * Get cart item count
     */
    public function count(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'item_count' => $this->cartService->getItemCount(),
                'is_empty' => $this->cartService->isEmpty(),
                'is_guest' => !Auth::check(),
            ],
        ]);
    }
}
