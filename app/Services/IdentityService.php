<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\UserDto;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Laravel\Sanctum\NewAccessToken;

final class IdentityService
{
    public function __construct(
        private readonly AuthManager $auth
    ) {}

    public function login(UserDto $dto): bool
    {
        return $this->auth->attempt(
            credentials: $dto->credentials()
        );
    }

    public function createToken(User $user): NewAccessToken
    {
        return $user->createToken(
            name: $user->name,
            abilities: [$user->role->value]
        );
    }
}
