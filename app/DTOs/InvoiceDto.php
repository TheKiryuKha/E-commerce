<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\InvoiceStatus;

final readonly class InvoiceDto
{
    public function __construct(
        public ?int $cost,
        public ?string $address,
        public ?string $user_telephone,
        public ?string $user_email,
        public ?InvoiceStatus $status
    ) {}

    /**
     * @param array{
     * cost?: ?int,
     * address?: ?string,
     * user_telephone?: ?string,
     * user_email?: ?string,
     * status?: ?InvoiceStatus
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            cost: $data['cost'] ?? null,
            address: $data['address'] ?? null,
            user_telephone: $data['user_telephone'] ?? null,
            user_email: $data['user_email'] ?? null,
            status: $data['status'] ?? null,
        );
    }
}
