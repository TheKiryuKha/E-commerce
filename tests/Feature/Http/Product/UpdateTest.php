<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->data = [
        'title' => 'Mayka',
        'description' => 'fucking Incredible Mayka',
        'price' => 1111,
        'status' => 'inStock',
        'quantity' => 10000,
    ];
    $this->user = User::factory()->vendor()->create();
});

it('returns correct status code', function () {
    $product = Product::factory()->for($this->user)->create();

    $response = $this->actingAs($this->user)->put(
        route('api:products:update', $product), $this->data
    );

    $response->assertStatus(200);
});

it('updates product', function () {
    $product = Product::factory()->for($this->user)->create();

    $this->actingAs($this->user)->put(
        route('api:products:update', $product), $this->data
    );

    expect($product->refresh()->toArray())->toMatchArray($this->data);
});

test('user cannot update not his product', function () {
    $product = Product::factory()->create();

    $response = $this->actingAs($this->user)->put(
        route('api:products:update', $product), $this->data
    );

    $response->assertStatus(403);
});

test('validation works', function () {
    $product = Product::factory()->for($this->user)->create();

    $response = $this->actingAs($this->user)->post(
        route('api:products:store', $product)
    );

    $response->assertInvalid([
        'title',
        'description',
        'status',
        'price',
        'quantity',
    ]);
});
