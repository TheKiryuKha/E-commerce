<?php

declare(strict_types=1);

use App\Models\User;

it('returns right the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:products:index')
    )->assertStatus(
        401
    );
});

it('returns right the correct status code if authenticated', function () {
    $this->actingAs(User::factory()->admin()->create())->getJson(
        route('api:products:index')
    )->assertStatus(
        200
    );
});
