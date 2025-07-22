<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\UserDto;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Laravel\Sanctum\NewAccessToken;

final readonly class IdentityService
{
    public function __construct(
        private AuthManager $auth
    ) {}

    public function login(UserDto $dto): bool
    {
        if (! $this->auth->attempt($dto->credentials())) {
            return false;
        }

        return $this->getUser()->hasVerifiedEmail();
    }

    public function createToken(): NewAccessToken
    {
        $user = $this->getUser();

        return $user->createToken(
            name: $user->name,
            abilities: [$user->role->value]
        );
    }

    private function getUser(): User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}
