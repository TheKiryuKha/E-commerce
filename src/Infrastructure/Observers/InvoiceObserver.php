<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\InvoiceStatus;
use App\Mail\OnWayMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

final class InvoiceObserver
{
    public function updated(Invoice $invoice): void
    {
        match ($invoice->status) {
            InvoiceStatus::OnWay => Mail::to($invoice->customer->email)
                ->send(new OnWayMail($invoice)),

            default => null
        };
    }
}
