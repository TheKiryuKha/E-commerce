<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->vendor()->create();
    $this->product = Product::factory()->for($this->user)->create();
});

it('returns correct status code', function () {

    $response = $this->actingAs($this->user)->delete(route(
        'api:products:destroy', $this->product
    ));

    $response->assertStatus(204);
});

it("delete's product", function () {

    $this->actingAs($this->user)->delete(route(
        'api:products:destroy', $this->product
    ));

    $this->assertDatabaseMissing('products', $this->product->toArray());
});

test('user cannot delete not his project', function () {
    $user = User::factory()->vendor()->create();

    $response = $this->actingAs($user)->delete(route(
        'api:products:destroy', $this->product
    ));

    $response->assertStatus(403);
});
