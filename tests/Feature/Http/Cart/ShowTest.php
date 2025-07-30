<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->cart = Cart::factory()->for($this->user)->create();
});

it('returns right the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:carts:show', $this->cart)
    )->assertStatus(
        401
    );
});

it('returns right the correct status code if authenticated', function () {
    $this->actingAs($this->user)->getJson(
        route('api:carts:show', $this->cart)
    )->assertStatus(
        200
    );
});

test('user cannot see not his cart', function () {
    $this->actingAs(User::factory()->create())->getJson(
        route('api:carts:show', $this->cart)
    )->assertStatus(
        403
    );
});
