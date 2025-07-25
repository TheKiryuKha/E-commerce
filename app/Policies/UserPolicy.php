<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

final class UserPolicy
{
    public function updateUserStatus(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function delete(User $user, User $targetUser): bool
    {
        foreach ($targetUser->invoices as $invoice) {
            if (! $invoice->isProcessed()) {
                return false;
            }
        }

        return $user->id === $targetUser->id;
    }
}
