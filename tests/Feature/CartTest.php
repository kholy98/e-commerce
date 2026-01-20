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
                    'en' => [
                        'items' => [
                            [
                                'product_id' => $this->product->id,
                                'product_name' => $this->product->name,
                                'price' => $this->product->price,
                                'quantity' => 1,
                                'subtotal' => 100.0,
                            ]
                        ],
                        'count' => 1,
                    ],
                    'ar' => [
                        'items' => [
                            [
                                'product_id' => $this->product->id,
                                'product_name' => $this->product->name,
                                'price' => $this->product->price,
                                'quantity' => 1,
                                'subtotal' => 100.0,
                            ]
                        ],
                        'count' => 1,
                    ],
                    'is_guest' => false,
                ],
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
            ->putJson("/api/cart/{$this->product->id}", [
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
                    'shipping' => 80.0, // Bosta shipping (Cairo)
                    'total' => 300.0, // 200 + 20 + 80
                    'item_count' => 2,
                ]
            ]);
    }

    public function test_checkout_initiation_logs()
    {
        // Add item to cart
        $this->user->carts()->create([
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        // Attempt checkout initiation
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/checkout/initiate', [
                'shipping_address' => [
                    'street' => '123 Main St',
                    'city' => 'Cairo',
                    'zip_code' => '12345',
                    'country' => 'Egypt',
                    'building_number' => '123',
                    'floor' => '4',
                    'apartment' => '4B',
                    'zone' => 'Nasr City'
                ],
                'billing_address' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john@example.com',
                    'phone' => '+201234567890',
                    'street' => '123 Main St',
                    'city' => 'Cairo',
                    'zip_code' => '12345',
                    'country' => 'Egypt',
                    'floor' => '4',
                    'apartment' => '4B'
                ],
                'notes' => 'Test order'
            ]);

        // We expect this to fail due to missing Paymob config, but it will generate logs
        $response->assertStatus(422); // Validation or API error
    }
}
