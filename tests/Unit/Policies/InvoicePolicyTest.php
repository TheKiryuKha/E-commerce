<?php

declare(strict_types=1);

use App\Models\Invoice;
use App\Models\User;

test('edit', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->create(['vendor_id' => $user->id]);

    $this->assertTrue($user->can('edit', $invoice));

    $user = User::factory()->create();

    $this->assertFalse($user->can('edit', $invoice));
});
