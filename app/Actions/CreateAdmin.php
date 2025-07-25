<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\UserDto;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateAdmin
{
    public function __construct(
        private CreateUser $action
    ) {}

    public function handle(UserDto $dto): User
    {
        return DB::transaction(function () use ($dto): User {
            
            $user = $this->action->handle($dto);

            $user->update([
                'role' => UserRole::Admin
            ]);

            return $user;
        });
    }
}