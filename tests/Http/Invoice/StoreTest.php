<?php

declare(strict_types=1);

use App\Enums\HistoryStatus;
use App\Enums\InvoiceStatus;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->vendor = User::factory()->vendor()->create();
    $this->user = User::factory()->create();
    $this->product = Product::factory()->make();

    $this->data = [
        'address' => 'Oskina',
        'user_telephone' => '375447191945',
        'vendor_id' => $this->vendor->id,
    ];
});

it("create's invoice", function () {
    $cart = Cart::factory()->create([
        'user_id' => $this->user->id,
        'amount' => $this->product->price,
    ]);
    $cart->products()->save($this->product);

    $this->actingAs($this->user)->post(
        route('api:invoices:store', $cart),
        $this->data
    );

    $this->assertDatabaseHas('invoices', [
        'customer_id' => $this->user->id,
        'vendor_id' => $this->vendor->id,
        'cost' => $this->product->price,
        'address' => 'Oskina',
        'user_telephone' => '375447191945',
        'user_email' => $this->user->email,
        'status' => InvoiceStatus::Paid,
    ]);
});

it("save's user purchase in history", function () {
    $cart = Cart::factory()->create([
        'user_id' => $this->user->id,
        'amount' => $this->product->price,
    ]);
    $cart->products()->save($this->product);

    $this->actingAs($this->user)->post(
        route('api:invoices:store', $cart),
        $this->data
    );

    $this->assertDatabaseHas('histories', [
        'user_id' => $this->user->id,
        'product_id' => $this->product->id,
        'status' => HistoryStatus::Purchased,
    ]);
});

test('created invoice has products from cart', function () {
    $cart = Cart::factory()->create([
        'user_id' => $this->user->id,
        'amount' => $this->product->price,
    ]);
    $cart->products()->save($this->product);

    $this->actingAs($this->user)->post(
        route('api:invoices:store', $cart),
        $this->data
    );

    $this->assertTrue(Invoice::first()->products->contains($this->product));
});

test('user cannot buy products no from his cart', function () {
    $cart = Cart::factory()->create();
    $cart->products()->save($this->product);

    $response = $this->actingAs($this->user)->post(
        route('api:invoices:store', $cart),
        $this->data
    );

    $response->assertStatus(403);
});
