<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInquiry>
 */
class ContactInquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'company' => fake()->optional()->company(),
            'message' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'replied', 'closed']),
            'is_published' => false,
            'replied_at' => null,
            'reply_message' => null,
        ];
    }

    /**
     * Indicate that the inquiry is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'replied_at' => null,
            'reply_message' => null,
        ]);
    }

    /**
     * Indicate that the inquiry has been replied.
     */
    public function replied(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'replied',
            'replied_at' => now(),
            'reply_message' => fake()->paragraph(),
        ]);
    }

    /**
     * Indicate that the inquiry is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'status' => 'replied',
            'replied_at' => now(),
            'reply_message' => fake()->paragraph(),
        ]);
    }
}
