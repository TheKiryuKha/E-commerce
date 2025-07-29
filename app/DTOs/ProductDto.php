<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\ProductStatus;

final readonly class ProductDto
{
    public function __construct(
        public string $title,
        public string $description,
        public int $price,
        public ProductStatus $status,
        public int $quantity
    ) {}

    /**
     * @param array{
     * title: string,
     * description: string,
     * price: int,
     * status: ProductStatus,
     * quantity: int
     * } $data
     */
    public static function make(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            price: $data['price'],
            status: $data['status'],
            quantity: $data['quantity'],
        );
    }

    /**
     * @return array{
     * title: string,
     * description: string,
     * price: int,
     * status: ProductStatus,
     * quantity: int
     * }
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'quantity' => $this->quantity,
        ];
    }
}
