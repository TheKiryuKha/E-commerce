<?php

declare(strict_types=1);

namespace App\Events\V1;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class UserUpdatedStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param array{
     * status?: ?UserStatus
     * } $updates
     */
    public function __construct(
        public User $user
    ) {}
}
