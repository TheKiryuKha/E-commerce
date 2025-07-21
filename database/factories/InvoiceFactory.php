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
            'user_id' => User::factory(),
            'cost' => random_int(10, 10000),
            'address' => fake()->address(),
            'user_telephone' => fake()->phoneNumber(),
            'user_email' => fake()->email(),
            'status' => InvoiceStatus::Paid,
        ];
    }
}
