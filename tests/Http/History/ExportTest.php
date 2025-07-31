<?php

declare(strict_types=1);

use App\Models\User;

it('returns right the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:histories:export')
    )->assertStatus(
        401
    );
});

it('returns right the correct status code if authenticated', function () {
    $this->actingAs(User::factory()->admin()->create())->getJson(
        route('api:histories:export')
    )->assertStatus(
        200
    );
});

test('only admin can export history', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('api:histories:export'));

    $response->assertStatus(403);
});
