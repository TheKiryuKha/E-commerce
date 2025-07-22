<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\RegisteredUser;
use App\Mail\VerificationLinkMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

final class SendVerificationEmail implements ShouldQueue
{
    public function handle(RegisteredUser $event): void
    {
        $link = route('api:auth:verify', [
            'user' => $event->user->id,
            'hash' => hash('sha256', $event->user->email),
        ]);

        Mail::to($event->user->email)
            ->send(new VerificationLinkMail($link));
    }
}
