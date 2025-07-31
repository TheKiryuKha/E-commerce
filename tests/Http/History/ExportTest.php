<?php

declare(strict_types=1);

use App\Models\User;

test('only admin can export history', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('api:histories:export'));

    $response->assertStatus(403);
});
