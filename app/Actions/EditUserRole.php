<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\UserDto;
use App\Events\UserUpdatedRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class EditUserRole
{
    public function handle(User $user, UserDto $dto): void
    {
        DB::transaction(function () use ($user, $dto): void {
            $user->update([
                'role' => $dto->role,
            ]);

            UserUpdatedRole::dispatch($user);
        });
    }
}
