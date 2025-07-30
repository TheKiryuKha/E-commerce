<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->cart = Cart::factory()->for($this->user)->create();
});

it('adds product to cart', function () {
    $product = Product::factory()->create();

    $this->actingAs($this->user)->post(
        route('api:carts:item:store', $this->cart),
        ['product_id' => $product->id]
    );

    expect($this->cart->products->contains($product));
});

it("updates cart's data after adding product", function () {
    $product = Product::factory()->create();

    $this->actingAs($this->user)->post(
        route('api:carts:item:store', $this->cart),
        ['product_id' => $product->id]
    );

    expect($this->cart->refresh())
        ->amount->toBe($product->price)
        ->products_amount->toBe(1);
});

it('returns correct status code', function () {
    $product = Product::factory()->create();

    $response = $this->actingAs($this->user)->post(
        route('api:carts:item:store', $this->cart),
        ['product_id' => $product->id]
    );

    $response->assertStatus(200);
});

test('user cannot add product not to his cart', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(
        route('api:carts:item:store', $this->cart),
        ['product_id' => $product->id]
    );

    $response->assertStatus(403);
});

test('cannot add product which is not available', function () {
    $product = Product::factory()->notAvailable()->create();

    $response = $this->actingAs($this->user)->post(
        route('api:carts:item:store', $this->cart),
        ['product_id' => $product->id]
    );

    $response->assertStatus(302);
});
