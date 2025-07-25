<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Enums\UserRole;

trait UserFilter
{
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin
            && $this->tokenCan(UserRole::Admin->value);
    }

    public function isDischarged(): bool
    {
        foreach ($this->invoices as $invoice) {
            if (! $invoice->isProcessed()) {
                return false;
            }
        }

        return true;
    }
}
