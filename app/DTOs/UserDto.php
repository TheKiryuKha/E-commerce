<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\UserRole;

final readonly class UserDto
{
    public function __construct(
        public ?string $name,
        public ?UserRole $role,
        public string $email,
        public string $password
    ) {}

    /**
     * @param array{
     * name?: ?string,
     * role?: ?UserRole,
     * email: string,
     * password: string
     * } $attr
     */
    public static function make(array $attr): self
    {
        return new self(
            name: $attr['name'] ?? null,
            role: $attr['role'] ?? null,
            email: $attr['email'],
            password: $attr['password']
        );
    }

    /**
     * @return array{email: string, password: string}
     */
    public function credentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
