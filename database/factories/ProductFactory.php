<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(random_int(1, 5), true),
            'description' => fake()->text(),
            'user_id' => User::factory(),
            'price' => random_int(1, 1000000),
            'status' => ProductStatus::InStock,
            'quantity' => random_int(1, 1000),
        ];
    }
}
