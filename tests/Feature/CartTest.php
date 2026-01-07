<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test category
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'is_active' => true,
        ]);

        // Create a test user
        $this->user = User::factory()->create();

        // Create a test product
        $this->product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100.00,
            'stock' => 10,
            'is_active' => true,
            'category_id' => $category->id,
        ]);
    }

    public function test_user_can_add_product_to_cart()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/cart/add', [
                'product_id' => $this->product->id,
                'quantity' => 2,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Item added to cart',
            ]);

        // Check that cart item was created in database
        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);
    }

    public function test_user_can_view_cart()
    {
        // Add item to cart first
        $this->user->carts()->create([
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/cart');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'items' => [
                        [
                            'product_id' => $this->product->id,
                            'product_name' => $this->product->name,
                            'price' => $this->product->price,
                            'quantity' => 1,
                            'subtotal' => 100.0,
                        ]
                    ],
                    'total' => 100.0,
                    'item_count' => 1,
                ]
            ]);
    }

    public function test_user_can_update_cart_item_quantity()
    {
        // Add item to cart first
        $cartItem = $this->user->carts()->create([
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->patchJson("/api/cart/{$this->product->id}", [
                'quantity' => 3,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Cart updated',
            ]);

        // Check that quantity was updated
        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'quantity' => 3,
        ]);
    }

    public function test_user_can_remove_item_from_cart()
    {
        // Add item to cart first
        $this->user->carts()->create([
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/cart/{$this->product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Item removed from cart',
            ]);

        // Check that cart item was removed
        $this->assertDatabaseMissing('carts', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);
    }

    public function test_user_can_clear_cart()
    {
        // Add multiple items to cart
        $this->user->carts()->create([
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $product2 = Product::factory()->create();
        $this->user->carts()->create([
            'product_id' => $product2->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson('/api/cart');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Cart cleared',
            ]);

        // Check that all cart items were removed
        $this->assertDatabaseMissing('carts', [
            'user_id' => $this->user->id,
        ]);
    }

    public function test_user_can_get_cart_summary()
    {
        // Add item to cart
        $this->user->carts()->create([
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/cart/summary');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'subtotal' => 200.0, // 100 * 2
                    'tax' => 20.0, // 10% of 200
                    'shipping' => 0.0, // Since subtotal > 100
                    'total' => 220.0, // 200 + 20 + 0
                    'item_count' => 2,
                ]
            ]);
    }
}
