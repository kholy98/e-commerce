<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\Paginator;

class CartService
{
    /**
     * Add item to cart
     */
    public function addItem(array $cart, int $productId, int $quantity): array
    {
        $product = Product::find($productId);

        if (!$product || !$product->is_active) {
            throw new \Exception('Product not available');
        }

        if (!$product->hasStock($quantity)) {
            throw new \Exception('Insufficient stock');
        }

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId] + $quantity;
            if (!$product->hasStock($newQuantity)) {
                throw new \Exception('Cannot add more, insufficient stock');
            }
            $cart[$productId] = $newQuantity;
        } else {
            $cart[$productId] = $quantity;
        }

        return $cart;
    }

    /**
     * Update item quantity in cart
     */
    public function updateItem(array $cart, int $productId, int $quantity): array
    {
        $product = Product::find($productId);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        if ($quantity === 0) {
            unset($cart[$productId]);
        } else {
            if (!$product->hasStock($quantity)) {
                throw new \Exception('Insufficient stock for this quantity');
            }
            $cart[$productId] = $quantity;
        }

        return $cart;
    }

    /**
     * Remove item from cart
     */
    public function removeItem(array $cart, int $productId): array
    {
        unset($cart[$productId]);
        return $cart;
    }

    /**
     * Get cart summary with totals
     */
    public function getSummary(array $cart, string $shippingCity = null): array
    {
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

        // Use Bosta pricing service for shipping calculation
        $bostaPricing = app(\App\Services\BostaPricingService::class);
        $shipping = $bostaPricing->calculateShippingCost($shippingCity ?: 'cairo', null, $subtotal);

        $total = $subtotal + $tax + $shipping;

        return [
            'subtotal' => round($subtotal, 2),
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => round($total, 2),
            'item_count' => $itemCount,
        ];
    }

    /**
     * Get formatted cart items
     */
    public function getFormattedItems(array $cart): array
    {
        $cartItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $cartItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => round($subtotal, 2),
                ];
            }
        }

        return $cartItems;
    }
}
