<?php

declare(strict_types=1);

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\User;

it('updates invoice status', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->paid()->create([
        'vendor_id' => $user->id,
    ]);

    $this->actingAs($user)->patch(route('api:invoices:update', $invoice), [
        'status' => InvoiceStatus::Received->value,
    ]);

    expect($invoice->refresh()->status)->toBe(InvoiceStatus::Received);
});

it('returns right status code', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->paid()->create([
        'vendor_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->patch(route('api:invoices:update', $invoice), [
        'status' => InvoiceStatus::Received->value,
    ]);

    $response->assertStatus(200);
});

test('user cannot update not his invoice', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->paid()->create();

    $response = $this->actingAs($user)->patch(route('api:invoices:update', $invoice), [
        'status' => InvoiceStatus::Received->value,
    ]);

    $response->assertStatus(403);
});
