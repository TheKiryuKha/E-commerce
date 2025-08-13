<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\UserDto;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Events\RegisteredUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateUser
{
    public function handle(UserDto $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = User::create([
                'name' => $dto->email,
                'status' => UserStatus::Active,
                'role' => UserRole::Customer,
                ...$dto->toArray(),
            ]);

            RegisteredUser::dispatch($user);

            return $user;

        });
    }
}
