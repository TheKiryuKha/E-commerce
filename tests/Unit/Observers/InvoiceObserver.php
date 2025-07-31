<?php

declare(strict_types=1);

use App\Enums\InvoiceStatus;
use App\Mail\OnWayMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

it('sends onWay email', function () {
    Mail::fake();
    $invoice = Invoice::factory()->create();

    $invoice->update([
        'status' => InvoiceStatus::OnWay,
    ]);

    Mail::assertSent(OnWayMail::class);
});
