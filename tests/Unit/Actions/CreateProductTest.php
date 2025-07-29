<?php

declare(strict_types=1);

use App\Actions\CreateProduct;
use App\DTOs\ProductDto;
use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->dto = ProductDto::make([
        'title' => 'Mayka',
        'description' => 'fucking Incredible Mayka',
        'price' => 1111,
        'status' => ProductStatus::InStock,
        'quantity' => 10000,
    ]);

    $this->user = User::factory()->create();
});

it('creates product', function () {
    $action = app(CreateProduct::class);

    $action->handle($this->user, $this->dto);

    $this->assertDatabaseHas('products', [
        ...$this->dto->toArray(),
        'user_id' => $this->user->id,
    ]);
});

it('returns created product', function () {
    $action = app(CreateProduct::class);

    $product = $action->handle($this->user, $this->dto);

    expect($product)->toBeInstanceOf(Product::class);
});
