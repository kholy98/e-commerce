<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SessionCartService
{
    const SESSION_KEY = 'guest_cart';

    /**
     * Get cart items from session or database based on user authentication
     */
    public function getCartItems(): array
    {
        if (Auth::check()) {
            return $this->getDatabaseCartItems();
        }

        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Get cart items from database for authenticated user
     */
    private function getDatabaseCartItems(): array
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        $items = [];

        foreach ($cartItems as $cartItem) {
            if ($cartItem->product) {
                $items[$cartItem->product_id] = $cartItem->quantity;
            }
        }

        return $items;
    }

    /**
     * Add item to cart (session or database)
     */
    public function addItem(int $productId, int $quantity): array
    {
        $product = Product::find($productId);

        if (!$product || !$product->is_active) {
            throw new \Exception('Product not available');
        }

        if (!$product->hasStock($quantity)) {
            throw new \Exception('Insufficient stock');
        }

        if (Auth::check()) {
            return $this->addDatabaseItem($productId, $quantity);
        }

        return $this->addSessionItem($productId, $quantity);
    }

    /**
     * Add item to session cart
     */
    private function addSessionItem(int $productId, int $quantity): array
    {
        $cart = Session::get(self::SESSION_KEY, []);

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId] + $quantity;
            $product = Product::find($productId);
            if (!$product->hasStock($newQuantity)) {
                throw new \Exception('Cannot add more, insufficient stock');
            }
            $cart[$productId] = $newQuantity;
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put(self::SESSION_KEY, $cart);
        return $cart;
    }

    /**
     * Add item to database cart
     */
    private function addDatabaseItem(int $productId, int $quantity): array
    {
        $user = Auth::user();
        $product = Product::find($productId);

        $existingCartItem = $user->carts()->where('product_id', $productId)->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $quantity;
            if (!$product->hasStock($newQuantity)) {
                throw new \Exception('Cannot add more, insufficient stock');
            }
            $existingCartItem->update(['quantity' => $newQuantity]);
        } else {
            $user->carts()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return $this->getDatabaseCartItems();
    }

    /**
     * Update item quantity in cart
     */
    public function updateItem(int $productId, int $quantity): array
    {
        $product = Product::find($productId);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        if (Auth::check()) {
            return $this->updateDatabaseItem($productId, $quantity);
        }

        return $this->updateSessionItem($productId, $quantity);
    }

    /**
     * Update item in session cart
     */
    private function updateSessionItem(int $productId, int $quantity): array
    {
        $cart = Session::get(self::SESSION_KEY, []);
        $product = Product::find($productId);

        if ($quantity === 0) {
            unset($cart[$productId]);
        } else {
            if (!$product->hasStock($quantity)) {
                throw new \Exception('Insufficient stock for this quantity');
            }
            $cart[$productId] = $quantity;
        }

        Session::put(self::SESSION_KEY, $cart);
        return $cart;
    }

    /**
     * Update item in database cart
     */
    private function updateDatabaseItem(int $productId, int $quantity): array
    {
        $user = Auth::user();
        $cartItem = $user->carts()->where('product_id', $productId)->first();

        if (!$cartItem) {
            throw new \Exception('Item not in cart');
        }

        if ($quantity === 0) {
            $cartItem->delete();
        } else {
            $product = Product::find($productId);
            if (!$product->hasStock($quantity)) {
                throw new \Exception('Insufficient stock for this quantity');
            }
            $cartItem->update(['quantity' => $quantity]);
        }

        return $this->getDatabaseCartItems();
    }

    /**
     * Remove item from cart
     */
    public function removeItem(int $productId): array
    {
        if (Auth::check()) {
            return $this->removeDatabaseItem($productId);
        }

        return $this->removeSessionItem($productId);
    }

    /**
     * Remove item from session cart
     */
    private function removeSessionItem(int $productId): array
    {
        $cart = Session::get(self::SESSION_KEY, []);
        unset($cart[$productId]);
        Session::put(self::SESSION_KEY, $cart);
        return $cart;
    }

    /**
     * Remove item from database cart
     */
    private function removeDatabaseItem(int $productId): array
    {
        $user = Auth::user();
        $cartItem = $user->carts()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return $this->getDatabaseCartItems();
    }

    /**
     * Clear entire cart
     */
    public function clearCart(): void
    {
        if (Auth::check()) {
            Auth::user()->carts()->delete();
        } else {
            Session::forget(self::SESSION_KEY);
        }
    }

    /**
     * Get cart summary with totals
     */
    public function getSummary(string $shippingCity = null): array
    {
        $cartItems = $this->getCartItems();
        $subtotal = 0;
        $itemCount = 0;

        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal += $product->price * $quantity;
                $itemCount += $quantity;
            }
        }

        $tax = round($subtotal * 0.1, 2);


        // Use Bosta pricing service for shipping calculation
        $bostaPricing = app(\App\Services\BostaPricingService::class);
        $shipping = $bostaPricing->calculateShippingCost($shippingCity ?: 'cairo', 'small_medium', $subtotal);

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
     * Get formatted cart items with product details
     */
    public function getFormattedItems(): array
    {
        $cartItems = $this->getCartItems();
        $formattedItems = [];

        foreach ($cartItems as $productId => $quantity) {
            $product = Product::with('category')->find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $formattedItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'slug' => $product->slug,
                    'description' => $product->description,
                    'price' => $product->price,
                    'sku' => $product->sku,
                    'stock' => $product->stock,
                    'is_active' => $product->is_active,
                    'category' => $product->category ? [
                        'id' => $product->category->id,
                        'name' => $product->category->name,
                        'slug' => $product->category->slug,
                    ] : null,
                    'quantity' => $quantity,
                    'subtotal' => round($subtotal, 2),
                ];
            }
        }

        return $formattedItems;
    }

    /**
     * Migrate session cart to database when user logs in
     */
    public function migrateSessionToDatabase(): void
    {
        if (!Auth::check()) {
            return;
        }

        $sessionCart = Session::get(self::SESSION_KEY, []);

        if (empty($sessionCart)) {
            return;
        }

        $user = Auth::user();

        foreach ($sessionCart as $productId => $quantity) {
            $product = Product::find($productId);
            if (!$product || !$product->is_active) {
                continue;
            }

            $existingCartItem = $user->carts()->where('product_id', $productId)->first();

            if ($existingCartItem) {
                $newQuantity = $existingCartItem->quantity + $quantity;
                if ($product->hasStock($newQuantity)) {
                    $existingCartItem->update(['quantity' => $newQuantity]);
                }
            } else {
                if ($product->hasStock($quantity)) {
                    $user->carts()->create([
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }

        // Clear session cart after migration
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Get cart item count
     */
    public function getItemCount(): int
    {
        $cartItems = $this->getCartItems();
        return array_sum($cartItems);
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty(): bool
    {
        return empty($this->getCartItems());
    }
}
