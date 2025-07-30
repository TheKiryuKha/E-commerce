<?php

declare(strict_types=1);

use App\Enums\HistoryStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Cart;
use App\Models\History;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Carbon\CarbonImmutable;

test('to array', function () {
    $user = User::factory()->create()->fresh();

    expect(array_keys($user->toArray()))->toBe([
        'id',
        'name',
        'role',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
    ]);
});

test('created_at', function () {
    $user = User::factory()->create();

    expect($user->created_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('updated_at', function () {
    $user = User::factory()->create();

    expect($user->updated_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('deleted_at', function () {
    $user = User::factory()->create([
        'deleted_at' => now(),
    ]);

    expect($user->deleted_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('status', function () {
    $user = User::factory()->create();

    expect($user->status)->toBeInstanceOf(UserStatus::class);
});

test('role', function () {
    $user = User::factory()->create();

    expect($user->role)->toBeInstanceOf(UserRole::class);
});

it('has products', function () {
    $user = User::factory()->vendor()->create();
    $product = Product::factory()->make();

    $user->products()->save($product);

    $this->assertTrue($user->products->contains($product));
});

it('has cart', function () {
    $user = User::factory()->create();
    $cart = Cart::factory()->make();

    $user->cart()->save($cart);

    expect($user->id)->toBe($cart->user_id);
});

it('has histories', function () {
    $user = User::factory()->create();
    $history = History::factory()->create();

    $user->history()->save($history);

    $this->assertTrue($user->history->contains($history));
});

it('has purchases', function () {
    $user = User::factory()->create();
    $purchase = Invoice::factory()->create();

    $user->purchases()->save($purchase);

    $this->assertTrue($user->purchases->contains($purchase));
});

it('has invoices', function () {
    $user = User::factory()->vendor()->create();
    $invoice = Invoice::factory()->create();

    $user->invoices()->save($invoice);

    $this->assertTrue($user->invoices->contains($invoice));
});

test('is viewed false', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $this->assertFalse($user->isViewed($product));
});

test('is viewed true', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    History::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'status' => HistoryStatus::Viewed,
        'time' => now(),
    ]);

    $this->assertTrue($user->isViewed($product));
});
