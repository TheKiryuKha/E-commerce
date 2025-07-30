<?php

declare(strict_types=1);

use App\Actions\AddProductToCart;
use App\Models\Cart;
use App\Models\Product;

beforeEach(function () {
    $this->action = app(AddProductToCart::class);
});

it('adds product to cart', function () {
    $product = Product::factory()->create();
    $cart = Cart::factory()->create();

    $this->action->handle($cart, $product);

    $this->assertTrue($cart->products->contains($product));
});
