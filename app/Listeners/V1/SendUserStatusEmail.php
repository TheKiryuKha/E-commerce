<?php

declare(strict_types=1);

namespace App\Listeners\V1;

use App\Enums\UserStatus;
use App\Events\V1\UserUpdatedStatus;
use App\Mail\V1\BannedUserMail;
use App\Mail\V1\UnbannedUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

final class SendUserStatusEmail implements ShouldQueue
{
    public function handle(UserUpdatedStatus $event): void
    {
        if ($event->user->status === UserStatus::Banned) {
            Mail::to($event->user->email)->send(
                new BannedUserMail($event->user, $event->message)
            );
        } else {
            Mail::to($event->user->email)->send(
                new UnbannedUserMail($event->user)
            );
        }
    }
}
