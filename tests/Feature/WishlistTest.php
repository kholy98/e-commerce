<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishlistTest extends TestCase
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

    public function test_user_can_view_their_wishlist()
    {
        // Add item to wishlist first
        Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/wishlist');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'product' => [
                            'id',
                            'name',
                            'name_ar',
                            'slug',
                            'price',
                            'stock',
                            'is_active',
                            'image',
                        ],
                        'created_at',
                    ],
                ],
                'count',
            ]);
    }

    public function test_user_can_add_product_to_wishlist()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/wishlist', [
                'product_id' => $this->product->id,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'product_id',
                    'created_at',
                ],
            ]);

        // Check that wishlist item was created in database
        $this->assertDatabaseHas('wishlist', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);
    }

    public function test_user_cannot_add_inactive_product_to_wishlist()
    {
        // Create inactive product
        $inactiveProduct = Product::factory()->create([
            'is_active' => false,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/wishlist', [
                'product_id' => $inactiveProduct->id,
            ]);

        $response->assertStatus(422)
            ->assertJson(['message' => 'Product is not available']);
    }

    public function test_user_cannot_add_same_product_to_wishlist_twice()
    {
        // Add product to wishlist first
        Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/wishlist', [
                'product_id' => $this->product->id,
            ]);

        $response->assertStatus(422)
            ->assertJson(['message' => 'Product is already in your wishlist']);
    }

    public function test_user_can_remove_product_from_wishlist()
    {
        // Add item to wishlist first
        $wishlistItem = Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/wishlist/{$this->product->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product removed from wishlist successfully']);

        // Check that wishlist item was removed
        $this->assertDatabaseMissing('wishlist', [
            'id' => $wishlistItem->id,
        ]);
    }

    public function test_user_can_check_if_product_is_in_wishlist()
    {
        // Add product to wishlist first
        Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/wishlist/check/{$this->product->id}");

        $response->assertStatus(200)
            ->assertJson(['in_wishlist' => true]);
    }

    public function test_user_can_clear_their_wishlist()
    {
        // Add multiple items to wishlist
        $product2 = Product::factory()->create();
        Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);
        Wishlist::create([
            'user_id' => $this->user->id,
            'product_id' => $product2->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson('/api/wishlist');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'deleted_count',
            ]);

        // Check that all wishlist items were removed
        $this->assertDatabaseMissing('wishlist', [
            'user_id' => $this->user->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_wishlist_endpoints()
    {
        $response = $this->getJson('/api/wishlist');
        $response->assertStatus(401);

        $response = $this->postJson('/api/wishlist', ['product_id' => 1]);
        $response->assertStatus(401);

        $response = $this->deleteJson('/api/wishlist/1');
        $response->assertStatus(401);
    }
}
