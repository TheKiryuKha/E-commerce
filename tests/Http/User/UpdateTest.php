<?php

declare(strict_types=1);

use App\Models\Invoice;
use App\Models\User;

test('validation works', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['name' => 1212]
    );

    $response->assertInvalid([
        'name',
    ]);
});

test('user cannot update different user', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $response = $this->actingAs($user1)->patch(
        route('api:users:update', $user2),
        [
            'name' => 'Test',
            'role' => 'vendor',
        ]
    );

    $response->assertStatus(403);
});

test('user(customer) can change his name', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['name' => 'Test']
    )->assertStatus(200);

    expect($user->refresh()->name)->toBe('Test');
});

test('user(vendor) with unproccessed invoices can change his name', function () {
    $user = User::factory()->vendor()->create();
    Invoice::factory()->paid()->for($user, 'vendor')->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['name' => 'test']
    )->assertStatus(200);

    expect($user->refresh()->name)->toBe('test');
});

test('user(admin) can change his name', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['name' => 'test']
    )->assertStatus(200);

    expect($user->refresh()->name)->toBe('test');
});

test('user(vendor) can update his name', function () {
    $user = User::factory()->vendor()->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['name' => 'test']
    )->assertStatus(200);

    expect($user->refresh()->name)->toBe('test');
});
