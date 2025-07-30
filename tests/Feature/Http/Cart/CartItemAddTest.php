<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    Cart::factory()->for($this->user)->create();
});

it('adds product to cart', function () {
    $product = Product::factory()->create();

    $this->actingAs($this->user)->get(route(
        'api:products:addToCart', [$this->user, $product]
    ));

    expect($this->user->cart->products->contains($product));
});

it("updates cart's data after adding product", function () {
    $product = Product::factory()->create();

    $this->actingAs($this->user)->get(route(
        'api:products:addToCart', [$this->user, $product]
    ));

    $cart = $this->user->cart;

    expect($cart)
        ->amount->toBe($product->price)
        ->products_amount->toBe(1);
});

it('returns correct status code', function () {
    $product = Product::factory()->create();

    $response = $this->actingAs($this->user)->get(route(
        'api:products:addToCart', [$this->user, $product]
    ));

    $response->assertStatus(200);
});

test('user cannot add product not to his cart', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->get(route(
        'api:products:addToCart', [$this->user, $product]
    ));

    $response->assertStatus(403);
});
