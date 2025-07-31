<?php

declare(strict_types=1);

use App\Models\Invoice;
use App\Models\User;

test('to array', function () {
    $invoice = Invoice::factory()->create()->fresh();

    expect(array_keys($invoice->toArray()))->toBe([
        'id',
        'customer_id',
        'cost',
        'address',
        'user_telephone',
        'user_email',
        'status',
        'created_at',
        'updated_at',
        'vendor_id',
    ]);
});

it('belongs to customer', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->make();

    $user->purchases()->save($invoice);

    expect($invoice->customer->id)->toBe($user->id);
});
