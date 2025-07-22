<?php

declare(strict_types=1);

use App\Models\User;

test('User can verify his email by link', function () {
    $user = User::factory()->unverified()->create();

    $this->get(route('api:auth:verify', [
        'user' => $user->id,
        'hash' => hash('sha256', $user->email),
    ]));

    $this->assertTrue($user->refresh()->hasVerifiedEmail());
});

test('user cannot verify his email with wrong link', function () {
    $user = User::factory()->unverified()->create();

    $this->get(route('api:auth:verify', [
        'user' => $user->id,
        'hash' => hash('sha256', 'fake_email'),
    ]));

    $this->assertFalse($user->refresh()->hasVerifiedEmail());
});
