<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => UserRole::Customer,
            'status' => UserStatus::Active,
            'email' => fake()->unique()->safeEmail(),
        ];
    }

    public function vendor(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::Vendor,
        ]);
    }

    public function admin(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::Admin,
        ]);
    }

    public function banned(): self
    {
        return $this->state(fn (array $attributes): array => [
            'status' => UserStatus::Banned,
        ]);
    }
}
