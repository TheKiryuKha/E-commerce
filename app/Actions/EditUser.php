<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class EditUser
{
    public function handle(User $user, UserDto $dto): void
    {
        DB::transaction(function () use ($user, $dto): void {

            $user->update(
                $dto->toArray()
            );

            $user->products()->delete();
        });
    }
}
