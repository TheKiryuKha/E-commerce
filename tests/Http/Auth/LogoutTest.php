<?php

declare(strict_types=1);

use App\Models\User;

test('unauthenticated user cannot logout', function () {
    $this->postJson(
        route('api:auth:logout')
    )->assertStatus(
        401
    );
});

test('authenticated user can logout', function () {
    $user = User::factory()->create();
    $user->createToken(
        $user->name,
        [$user->role->value]
    );

    $this->actingAs($user)
        ->post(route('api:auth:logout'))
        ->assertStatus(204);

    $user->refresh();

    expect($user->tokens)->toBeEmpty();
});
