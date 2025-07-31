<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\InvoiceStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
final class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::factory(),
            'vendor_id' => User::factory()->vendor(),
            'cost' => random_int(10, 10000),
            'address' => fake()->address(),
            'user_telephone' => fake()->phoneNumber(),
            'user_email' => fake()->email(),
            'status' => InvoiceStatus::Received,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => InvoiceStatus::Paid,
        ]);
    }

    public function onWay(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => InvoiceStatus::OnWay,
        ]);
    }
}
