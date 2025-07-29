<?php

declare(strict_types=1);

use App\DTOs\ProductDto;
use App\Enums\ProductStatus;

beforeEach(function () {
    $this->data = [
        'title' => 'Mayka',
        'description' => 'fucking Incredible Mayka',
        'price' => 1111,
        'status' => ProductStatus::InStock,
        'quantity' => 10000,
    ];
});

test('make', function () {
    $dto = ProductDto::make($this->data);

    expect($dto)->toBeInstanceOf(ProductDto::class);

    expect($dto)
        ->title->toBe($this->data['title'])
        ->description->toBe($this->data['description'])
        ->price->toBe($this->data['price'])
        ->status->toBe($this->data['status'])
        ->quantity->toBe($this->data['quantity']);
});

test('to array', function () {
    $dto = new ProductDto(
        $this->data['title'],
        $this->data['description'],
        $this->data['price'],
        $this->data['status'],
        $this->data['quantity']
    );

    expect($dto->toArray())->toMatchArray($this->data);
});
