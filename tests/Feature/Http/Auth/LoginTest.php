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

test('cannot login with non-existent data', function () {
    $user = [
        'email' => 'test@mail.com',
        'password' => 'password',
    ];

    $response = $this->post(route('api:auth:login'), $user);

    $response->assertStatus(302);

    $this->assertGuest();
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
