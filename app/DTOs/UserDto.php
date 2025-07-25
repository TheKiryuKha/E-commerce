<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\UserRole;
use App\Enums\UserStatus;

final readonly class UserDto
{
    public function __construct(
        public ?string $name,
        public ?UserRole $role,
        public ?UserStatus $status,
        public ?string $email
    ) {}

    /**
     * @param array{
     * name?: ?string,
     * role?: ?UserRole,
     * email?: ?string,
     * status?: ?UserStatus
     * } $attr
     */
    public static function make(array $attr): self
    {
        return new self(
            name: $attr['name'] ?? null,
            role: $attr['role'] ?? null,
            status: $attr['status'] ?? null,
            email: $attr['email'] ?? null
        );
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
            'status' => $this->status,
        ];
    }
}
