<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;

final readonly class GetUserByEmail
{
    public function get(string $email): User
    {
        return User::where(
            'email',
            $email
        )->firstOrFail();
    }
}
