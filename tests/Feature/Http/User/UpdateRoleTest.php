<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;

test('user(customer) can become vendor', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->patch(
        route('api:users:updateRole', $user),
        ['role' => UserRole::Vendor->value]
    )->assertStatus(200);

    expect($user->refresh()->role)->toBe(UserRole::Vendor);
});

test('user(vendor) can stop being vendor', function () {
    $user = User::factory()->vendor()->create();
    Product::factory()->for($user)->create();

    $this->actingAs($user)->patch(
        route('api:users:updateRole', $user),
        ['role' => UserRole::Customer->value]
    )->assertStatus(200);

    $user->refresh();

    expect($user->role)->toBe(UserRole::Customer)
        ->and($user->products()->count())->toBe(0);
});

test('user(vendor) cannot stop being vendor, if he has unprocessed invoices', function () {
    $user = User::factory()->vendor()->create();
    Invoice::factory(3)->paid()->for($user, 'vendor')->create();

    $this->actingAs($user)->patch(
        route('api:users:updateRole', $user),
        ['role' => UserRole::Customer->value]
    )->assertStatus(403);
});
