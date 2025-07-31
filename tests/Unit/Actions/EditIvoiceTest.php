<?php

declare(strict_types=1);

use App\Actions\EditInvoice;
use App\DTOs\InvoiceDto;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;

beforeEach(function () {
    $this->invoice = Invoice::factory()->paid()->create();
    $this->dto = InvoiceDto::make(['status' => InvoiceStatus::Received]);
});

it("it edit's invoice's status", function () {
    $action = app(EditInvoice::class);

    $action->handle($this->invoice, $this->dto);

    expect($this->invoice->refresh()->status)
        ->toBe(InvoiceStatus::Received);
});
