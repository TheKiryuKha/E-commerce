<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

final readonly class CreateToken
{
    public function handle(User $user): NewAccessToken
    {
        return $user->createToken(
            name: $user->name,
            abilities: [$user->role]
        );
    }
}
