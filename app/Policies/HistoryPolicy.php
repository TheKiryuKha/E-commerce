<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class HistoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function export(User $user): bool
    {
        return $user->isAdmin();
    }
}
