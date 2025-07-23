<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(fn () => $this->code = '11111');

test('validation works', function () {
    $this->post(
        route('api:auth:login')
    )->assertInvalid([
        'code',
    ]);
});

test('cannot login with wrong data', function () {
    $this->post(
        route('api:auth:login'),
        ['code' => $this->code]
    )->assertStatus(
        302
    );
});

test('user can login', function () {
    $user = User::factory()->create();

    createAuthCode($user, $this->code);

    $response = $this->post(
        route('api:auth:login'),
        ['code' => $this->code]
    );

    $response->assertOk()->assertJsonStructure(['token']);

    expect($response->json('token'))->toBeString();
});
