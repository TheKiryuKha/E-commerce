<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

final class InvoicePolicy
{
    public function edit(User $user, Invoice $invoice): bool
    {
        return $user->id === $invoice->vendor_id;
    }
}
