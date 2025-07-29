<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(
    fn () => $this->data = [
        'title' => 'Mayka',
        'description' => 'fucking Incredible Mayka',
        'price' => 1111,
        'status' => 'inStock',
        'quantity' => 10000,
    ]
);

it('returns correct status after creating product', function () {
    $user = User::factory()->vendor()->create();

    $response = $this->actingAs($user)->post(route('api:products:store'), $this->data);

    $response->assertStatus(201);
});

it('creates new product', function () {
    $user = User::factory()->vendor()->create();

    $this->actingAs($user)->post(route('api:products:store'), $this->data);

    $this->assertDatabaseHas('products', [
        ...$this->data,
        'user_id' => $user->id,
    ]);
});

test('customer cannot create product', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('api:products:store'), $this->data);

    $response->assertStatus(403);
});

test('admin cannot create product', function () {
    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)->post(route('api:products:store'), $this->data);

    $response->assertStatus(403);
});

test('validation works', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('api:products:store'));

    $response->assertInvalid([
        'title',
        'description',
        'status',
        'price',
        'quantity',
    ]);
});
