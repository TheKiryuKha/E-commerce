<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Enums\InvoiceStatus;

trait InvoiceFilter
{
    public function isProcessed(): bool
    {
        return $this->status === InvoiceStatus::Received;
    }
}
