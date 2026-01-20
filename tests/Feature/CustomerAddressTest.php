<?php

namespace Tests\Feature;

use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerAddressTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_user_can_list_their_addresses()
    {
        CustomerAddress::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/addresses');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    ['user_id' => $this->user->id],
                    ['user_id' => $this->user->id],
                    ['user_id' => $this->user->id],
                ]
            ]);
    }

    public function test_user_can_create_address()
    {
        $addressData = [
            'label' => 'Home',
            'name' => 'John Doe',
            'phone' => '+201234567890',
            'address' => '123 Main Street',
            'city' => 'Cairo',
            'zip_code' => '12345',
            'country' => 'Egypt',
            'is_default' => true,
            'is_billing' => true,
            'is_shipping' => true,
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/addresses', $addressData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Address created successfully',
                'data' => array_merge($addressData, ['user_id' => $this->user->id])
            ]);

        $this->assertDatabaseHas('customer_addresses', array_merge($addressData, ['user_id' => $this->user->id]));
    }

    public function test_user_can_update_address()
    {
        $address = CustomerAddress::factory()->create(['user_id' => $this->user->id]);

        $updateData = [
            'name' => 'Jane Doe',
            'phone' => '+201234567891',
            'address' => $address->address, // Keep existing values for required fields
            'city' => $address->city,
            'zip_code' => $address->zip_code,
            'country' => $address->country,
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson("/api/addresses/{$address->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Address updated successfully',
                'data' => array_merge($address->toArray(), $updateData)
            ]);
    }

    public function test_user_can_delete_address()
    {
        $address = CustomerAddress::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/addresses/{$address->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Address deleted successfully'
            ]);

        $this->assertDatabaseMissing('customer_addresses', ['id' => $address->id]);
    }

    public function test_user_cannot_access_other_users_addresses()
    {
        $otherUser = User::factory()->create();
        $address = CustomerAddress::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/addresses/{$address->id}");

        $response->assertStatus(404);
    }

    public function test_setting_address_as_default_unsets_others()
    {
        // Create existing default address
        CustomerAddress::factory()->create([
            'user_id' => $this->user->id,
            'is_default' => true
        ]);

        // Create new address and set as default
        $newAddressData = [
            'name' => 'New Address',
            'phone' => '+201234567890',
            'address' => '456 New Street',
            'city' => 'Cairo',
            'zip_code' => '12345',
            'country' => 'Egypt',
            'is_default' => true,
        ];

        $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/addresses', $newAddressData);

        // Check that only one address is default
        $defaultAddresses = CustomerAddress::where('user_id', $this->user->id)
            ->where('is_default', true)
            ->count();

        $this->assertEquals(1, $defaultAddresses);
    }
}
