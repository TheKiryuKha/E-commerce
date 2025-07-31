<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Events\RegisteredUser;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    $this->user_data = [
        'name' => 'test',
        'role' => 'customer',
        'email' => 'test@mail.com',
        'password' => 'test_password',
        'password_confirmation' => 'test_password',
    ];
});

test('validation works', function () {
    $response = $this->post(route('api:auth:register'), [
        'role' => 'admin',
    ]);

    $response->assertInvalid([
        'email',
        'role',
    ]);
});

it('creates new user after registration', function () {
    $this->post(route('api:auth:register'), $this->user_data)
        ->assertStatus(200);

    expect(User::count())->toBe(1);

    $user = User::first();

    expect($user->name)->toBe('test@mail.com')
        ->and($user->email)->toBe('test@mail.com')
        ->and($user->role)->toBe(UserRole::Customer);
});

it('return right message after registration', function () {
    $response = $this->post(route('api:auth:register'), $this->user_data);

    expect($response->json('message'))->toBeString();
});

it('dispatches about new registered user', function () {
    Event::fake();

    $this->post(route('api:auth:register'), $this->user_data);

    Event::assertDispatched(RegisteredUser::class);
});

it('creates cart for new user after registration', function () {
    $this->post(route('api:auth:register'), $this->user_data)
        ->assertStatus(200);

    expect(Cart::count())->toBe(1);

    $cart = Cart::first();

    expect($cart->user()->value('id'))->toBe(User::first()->id)
        ->and($cart->amount)->toBe(0)
        ->and($cart->products_amount)->toBe(0)
        ->and($cart->products()->count())->toBe(0);
});
