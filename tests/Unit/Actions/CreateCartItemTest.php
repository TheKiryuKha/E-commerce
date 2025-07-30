<?php

declare(strict_types=1);

use App\Actions\CreateCartItem;
use App\Models\Cart;
use App\Models\Product;

beforeEach(function () {
    $this->action = app(CreateCartItem::class);
});

it('adds product to cart', function () {
    $product = Product::factory()->create();
    $cart = Cart::factory()->create();

    $this->action->handle($cart, $product->id);

    $this->assertTrue($cart->products->contains($product));
});

it("updates cart's data", function () {
    $product = Product::factory()->create();
    $cart = Cart::factory()->create();

    $this->action->handle($cart, $product->id);

    expect($cart)
        ->amount->toBe($product->price)
        ->products_amount->toBe(1);
});
