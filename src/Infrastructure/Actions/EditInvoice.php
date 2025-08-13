<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\InvoiceDto;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

final readonly class EditInvoice
{
    public function handle(Invoice $invoice, InvoiceDto $dto): void
    {
        DB::transaction(function () use ($invoice, $dto): void {

            $invoice->update([
                'status' => $dto->status,
            ]);

        });
    }
}
