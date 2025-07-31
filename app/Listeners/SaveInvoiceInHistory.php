<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\HistoryStatus;
use App\Events\NewInvoice;
use App\Models\History;

final class SaveInvoiceInHistory
{
    public function handle(NewInvoice $event): void
    {
        foreach ($event->invoice->products as $product) {
            History::create([
                'product_id' => $product->id,
                'user_id' => $event->invoice->customer_id,
                'status' => HistoryStatus::Purchased,
                'time' => now(),
            ]);
        }
    }
}
