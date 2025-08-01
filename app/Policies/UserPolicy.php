<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user): bool
    {
        return $user->isAdmin();
    }

    public function updateUserStatus(User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id
            && $targetUser->isDischarged();
    }

    public function updateRole(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id
            && $targetUser->isDischarged();
    }

    public function update(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id;
    }

    public function seeProducts(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser->id;
    }

    public function createAdmin(User $user): bool
    {
        return $user->isAdmin();
    }

    public function deleteAdmin(User $user): bool
    {
        return $user->isAdmin();
    }
}
