<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function delete(User $user, User $target_user): bool
    {
        foreach ($target_user->invoices as $invoice) {
            if (! $invoice->isProcessed()) {
                return false;
            }
        }

        return $user->id === $target_user->id;
    }
}
