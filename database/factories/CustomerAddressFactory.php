<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerAddress>
 */
class CustomerAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'label' => $this->faker->randomElement(['Home', 'Work', 'Office', null]),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'country' => 'Egypt',
            'state' => $this->faker->optional()->state(),
            'is_default' => false,
            'is_billing' => $this->faker->boolean(70),
            'is_shipping' => $this->faker->boolean(80),
        ];
    }

    /**
     * Indicate that the address is the default.
     */
    public function default(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_default' => true,
        ]);
    }

    /**
     * Indicate that the address is for billing.
     */
    public function billing(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_billing' => true,
        ]);
    }

    /**
     * Indicate that the address is for shipping.
     */
    public function shipping(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_shipping' => true,
        ]);
    }
}
