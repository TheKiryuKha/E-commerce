<?php

declare(strict_types=1);

use App\Models\User;

test('validation works', function () {
    $response = $this->post(route('api:auth:login'));

    $response->assertInvalid([
        'email',
        'password',
    ]);
});

test('cannot login with wrong data', function () {
    $user = [
        'email' => User::factory()->create()->email,
        'password' => 'wrongPassword',
    ];

    $response = $this->post(route('api:auth:login'), $user);

    $response->assertStatus(400);

    $this->assertGuest();
});

test('unverified user cannot login', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->post(route('api:auth:login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(400);
});

test('user can login', function () {
    $user = User::factory()->create();

    $response = $this->post(route('api:auth:login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk()
        ->assertJsonStructure(['token']);

    expect($response->json('token'))->toBeString();
    $this->assertAuthenticated();
});
