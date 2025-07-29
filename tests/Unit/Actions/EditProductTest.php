<?php

declare(strict_types=1);

use App\Actions\EditProduct;
use App\DTOs\ProductDto;
use App\Enums\ProductStatus;
use App\Models\Product;

beforeEach(function () {
    $this->action = app(EditProduct::class);
    $this->data = [
        'title' => 'Mayka',
        'description' => 'fucking Incredible Mayka',
        'price' => 1111,
        'status' => ProductStatus::InStock,
        'quantity' => 10000,
    ];
    $this->dto = ProductDto::make($this->data);
});

it('updates product', function () {
    $product = Product::factory()->create();

    $this->action->handle($product, $this->dto);

    expect($product->refresh())
        ->title->toBe($this->data['title'])
        ->description->toBe($this->data['description'])
        ->price->toBe($this->data['price'])
        ->status->toBe($this->data['status'])
        ->quantity->toBe($this->data['quantity']);
});
