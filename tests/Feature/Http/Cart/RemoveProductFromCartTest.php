<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->cart = Cart::factory()->for($this->user)->create();
});

it('removes product from cart', function () {
    $product = Product::factory()->create();
    $this->cart->products()->attach($product);

    $this->actingAs($this->user)->get(route(
        'api:products:removeFromCart', 
        [$this->user, $product]
    ));

    $this->assertFalse(
        $this->cart->products->contains($product)
    );
});

test('user cannot remove product from not his cart', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $this->cart->products()->attach($product);

    $response = $this->actingAs($user)->get(route(
        'api:products:removeFromCart', 
        [$this->user, $product]
    ));

    $response->assertStatus(403);
});