<?php

declare(strict_types=1);

use App\Enums\ProductStatus;
use App\Models\Cart;
use App\Models\History;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Carbon\CarbonImmutable;

test('to array', function () {
    $product = Product::factory()->create()->fresh();

    expect(array_keys($product->toArray()))->toBe([
        'id',
        'title',
        'description',
        'user_id',
        'price',
        'status',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ]);
});

test('status', function () {
    $product = Product::factory()->create();

    expect($product->status)->toBeInstanceOf(ProductStatus::class);
});

test('created_at', function () {
    $product = Product::factory()->create();

    expect($product->created_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('updated_at', function () {
    $product = Product::factory()->create();

    expect($product->updated_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('deleted_at', function () {
    $product = Product::factory()->create([
        'deleted_at' => now(),
    ]);

    expect($product->deleted_at)->toBeInstanceOf(CarbonImmutable::class);
});

it('belongs to user', function () {
    $user = User::factory()->create();
    $product = Product::factory()->make();

    $user->products()->save($product);

    expect($product->user)->toBeInstanceOf(User::class);
});

it('has history', function () {
    $product = Product::factory()->create();
    $history = History::factory()->create();

    $product->history()->save($history);

    $this->assertTrue($product->history->contains($history));
});

it('has invoices', function () {
    $product = Product::factory()->create();
    $invoice = Invoice::factory()->create();

    $product->invoices()->save($invoice);

    $this->assertTrue($product->invoices->contains($invoice));
});

it('belongs to carts', function () {
    $product = Product::factory()->create();
    $cart = Cart::factory()->create();

    $product->carts()->save($cart);

    $this->assertTrue($product->carts->contains($cart));
});
