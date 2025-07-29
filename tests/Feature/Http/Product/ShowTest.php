<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;

beforeEach(
    fn () => $this->product = Product::factory()->create()
);

it('returns right the correct status code if unauthenticated', function () {
    $this->getJson(
        route('api:products:show', $this->product)
    )->assertStatus(
        401
    );
});

it('returns right the correct status code if authenticated', function () {
    $this->actingAs(User::factory()->admin()->create())->getJson(
        route('api:products:show', $this->product)
    )->assertStatus(
        200
    );
});
