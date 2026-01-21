<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\SessionCartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Cart
 *
 * APIs for managing the shopping cart.
 *
 * The cart system supports both guest users (session-based) and authenticated users (database-based).
 * When a guest user logs in, their session cart is automatically migrated to their user account.
 */
class CartController extends Controller
{
    protected SessionCartService $cartService;

    public function __construct(SessionCartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Get cart items
     *
     * Retrieve all items in the user's cart with localized product information.
     * Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "en": {
     *       "items": [
     *         {
     *           "product_id": 1,
     *           "name": "Premium Coffee",
     *           "price": 25.00,
     *           "quantity": 2,
     *           "subtotal": 50.00,
     *           "image_url": "https://example.com/images/coffee.jpg"
     *         }
     *       ],
     *       "count": 2
     *     },
     *     "ar": {
     *       "items": [
     *         {
     *           "product_id": 1,
     *           "name": "قهوة ممتازة",
     *           "price": 25.00,
     *           "quantity": 2,
     *           "subtotal": 50.00,
     *           "image_url": "https://example.com/images/coffee.jpg"
     *         }
     *       ],
     *       "count": 2
     *     },
     *     "summary": {
     *       "subtotal": 50.00,
     *       "tax": 5.00,
     *       "shipping": 10.00,
     *       "total": 65.00
     *     },
     *     "is_guest": false
     *   }
     * }
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
                'is_guest' => ! Auth::check(),
            ],
        ]);
    }

    /**
     * Add item to cart
     *
     * Add a product to the shopping cart. If the product already exists in the cart,
     * the quantity will be increased. Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @bodyParam product_id integer required The ID of the product to add. Example: 1
     * @bodyParam quantity integer required The quantity to add (minimum 1). Example: 2
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Item added to cart",
     *   "cart_summary": {
     *     "subtotal": 50.00,
     *     "tax": 5.00,
     *     "shipping": 10.00,
     *     "total": 65.00,
     *     "item_count": 2
     *   }
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The product id field is required.",
     *   "errors": {
     *     "product_id": ["The product id field is required."]
     *   }
     * }
     * @response 422 scenario="Out of Stock" {
     *   "success": false,
     *   "message": "Product is out of stock."
     * }
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
     * Update cart item quantity
     *
     * Update the quantity of a specific item in the cart.
     * Setting quantity to 0 will remove the item from the cart.
     * Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @urlParam productId integer required The product ID to update. Example: 1
     *
     * @bodyParam quantity integer required The new quantity (0 to remove). Example: 3
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Cart updated",
     *   "cart_summary": {
     *     "subtotal": 75.00,
     *     "tax": 7.50,
     *     "shipping": 10.00,
     *     "total": 92.50,
     *     "item_count": 3
     *   }
     * }
     * @response 404 scenario="Product Not Found" {
     *   "success": false,
     *   "message": "Product not found"
     * }
     * @response 422 scenario="Insufficient Stock" {
     *   "success": false,
     *   "message": "Requested quantity exceeds available stock."
     * }
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
     * Remove item from cart
     *
     * Remove a specific product from the shopping cart.
     * Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @urlParam productId integer required The product ID to remove. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Item removed from cart",
     *   "cart_summary": {
     *     "subtotal": 25.00,
     *     "tax": 2.50,
     *     "shipping": 10.00,
     *     "total": 37.50,
     *     "item_count": 1
     *   }
     * }
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
     * Clear cart
     *
     * Remove all items from the shopping cart.
     * Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Cart cleared"
     * }
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
     * Get cart summary
     *
     * Get a summary of the cart including subtotal, tax, shipping, and total.
     * Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "subtotal": 100.00,
     *     "tax": 10.00,
     *     "shipping": 15.00,
     *     "total": 125.00,
     *     "item_count": 4,
     *     "discount": 0.00
     *   }
     * }
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
     *
     * Get the total number of items in the cart and check if it's empty.
     * Useful for displaying cart badge counts in the UI.
     * Works for both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "data": {
     *     "item_count": 3,
     *     "is_empty": false,
     *     "is_guest": true
     *   }
     * }
     * @response 200 scenario="Empty Cart" {
     *   "success": true,
     *   "data": {
     *     "item_count": 0,
     *     "is_empty": true,
     *     "is_guest": false
     *   }
     * }
     */
    public function count(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'item_count' => $this->cartService->getItemCount(),
                'is_empty' => $this->cartService->isEmpty(),
                'is_guest' => ! Auth::check(),
            ],
        ]);
    }
}
