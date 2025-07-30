<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->product = Product::factory()->create();
    $this->cart = Cart::factory()->for($this->user)->create([
        'products_amount' => 1,
        'amount' => $this->product->price,
    ]);
});

it('removes product from cart', function () {
    $this->cart->products()->attach($this->product);

    $this->actingAs($this->user)->delete(
        route('api:carts:item:destroy', $this->cart),
        ['product_id' => $this->product->id]
    );

    $this->cart->refresh();

    $this->assertFalse(
        $this->cart->products->contains($this->product)
    );
});

it('updates card data after removing product from cart', function () {
    $this->cart->products()->attach($this->product);

    $this->actingAs($this->user)->delete(
        route('api:carts:item:destroy', $this->cart),
        ['product_id' => $this->product->id]
    );

    expect($this->cart->refresh())
        ->amount->toBe(0)
        ->products_amount->toBe(0);
});

test('user cannot remove product from not his cart', function () {
    $user = User::factory()->create();
    $this->cart->products()->attach($this->product);

    $response = $this->actingAs($user)->delete(
        route('api:carts:item:destroy', $this->cart),
        ['product_id' => $this->product->id]
    );

    $response->assertStatus(403);
});
