<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\HistoryStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
final class HistoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'status' => fake()->randomElement(HistoryStatus::cases()),
            'time' => now(),
        ];
    }
}
