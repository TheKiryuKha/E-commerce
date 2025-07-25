<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\UserStatus;
use App\Events\UserUpdatedStatus;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class EditUserStatus
{
    /**
     * @param  array{status: UserStatus, message: string}  $data
     */
    public function handle(User $user, array $data): void
    {
        DB::transaction(function () use ($user, $data): void {

            $user->update([
                'status' => $data['status'],
            ]);

            UserUpdatedStatus::dispatch($user, $data['message']);
        });
    }
}
