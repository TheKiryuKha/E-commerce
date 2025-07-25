<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;

test('validation works', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->patch(
        route('api:users:update', $user),
        [
            'name' => 1212,
            'role' => 'wrong_role',
        ]
    );

    $response->assertInvalid([
        'name',
        'role',
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

test('user(customer) can become vendor', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['role' => UserRole::Vendor->value]
    )->assertStatus(200);

    expect($user->refresh()->role)->toBe(UserRole::Vendor);
});

test('user(vendor) can stop being vendor', function () {
    $user = User::factory()->vendor()->create();
    Product::factory()->for($user)->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['role' => UserRole::Customer->value]
    )->assertStatus(200);

    $user->refresh();

    expect($user->role)->toBe(UserRole::Customer)
        ->and($user->products()->count())->toBe(0);
});

test('user can change his name', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->patch(
        route('api:users:update', $user),
        ['name' => 'Test']
    )->assertStatus(200);

    expect($user->refresh()->name)->toBe('Test');
});
