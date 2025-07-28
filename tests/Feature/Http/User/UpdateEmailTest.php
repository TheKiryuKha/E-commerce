<?php

declare(strict_types=1);

use App\Models\User;

test('user can update his email', function () {
    $user = User::factory()->create();
    createAuthCode($user, '12345');

    $response = $this->actingAs($user)
        ->patch(route('api:users:email:update'), [
            'email' => 'fuckme@mail.com',
            'code' => '12345',
        ]);

    $response->assertStatus(200);

    expect($user->refresh()->email)->toBe('fuckme@mail.com');
});

test('validation works', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->patch(route('api:users:email:update'));

    $response->assertInvalid([
        'email',
        'code',
    ]);
});
