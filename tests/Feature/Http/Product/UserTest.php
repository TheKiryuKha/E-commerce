<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(
    fn () => $this->user = User::factory()->create()
);

it('returns right the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:products:user:index', $this->user)
    )->assertStatus(
        401
    );
});

it('returns right the correct status code if authenticated', function () {
    $this->actingAs(User::factory()->admin()->create())->getJson(
        route('api:products:user:index', $this->user)
    )->assertStatus(
        200
    );
});
