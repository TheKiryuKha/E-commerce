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
        public ?InvoiceStatus $status,
        public ?int $vendor_id,
    ) {}

    /**
     * @param array{
     * cost?: ?int,
     * address?: ?string,
     * user_telephone?: ?string,
     * user_email?: ?string,
     * status?: ?InvoiceStatus,
     * vendor_id?: ?int
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
            vendor_id: $data['vendor_id'] ?? null
        );
    }

    /**
     * @return array{
     * cost: ?int,
     * address: ?string,
     * user_telephone: ?string,
     * user_email: ?string,
     * status: ?InvoiceStatus,
     * vendor_id: ?int
     * }
     */
    public function toArray(): array
    {
        return [
            'cost' => $this->cost,
            'address' => $this->address,
            'user_telephone' => $this->user_telephone,
            'user_email' => $this->user_email,
            'status' => $this->status,
            'vendor_id' => $this->vendor_id,
        ];
    }
}
