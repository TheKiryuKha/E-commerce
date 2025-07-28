<?php

declare(strict_types=1);

use App\Actions\CreateCart;
use App\Models\Cart;
use App\Models\User;

beforeEach(
    fn () => $this->action = app(CreateCart::class)
);

it('creates cart for user', function () {
    $user = User::factory()->create();

    $this->action->handle($user);

    expect(Cart::first()->user_id)->toBe($user->id);
});

it('returns new created cart', function () {
    $user = User::factory()->create();

    $cart = $this->action->handle($user);

    expect($cart)->toBeInstanceOf(Cart::class);
});

test('amount of new cart is 0', function () {
    $user = User::factory()->create();

    $this->action->handle($user);

    expect(Cart::first()->amount)->toBe(0);
});

test('products_amount of new cart is 0', function () {
    $user = User::factory()->create();

    $this->action->handle($user);

    expect(Cart::first()->products_amount)->toBe(0);
});
