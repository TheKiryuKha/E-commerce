<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\UserRole;
use App\Events\UserUpdatedRole;

final class DeleteUserProducts
{
    public function handle(UserUpdatedRole $event): void
    {
        $user = $event->user;

        if ($user->role === UserRole::Customer) {
            $user->products()->delete();
        }
    }
}
