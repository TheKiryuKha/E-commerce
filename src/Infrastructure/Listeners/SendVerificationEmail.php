<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\SendAuthCode;
use App\Events\RegisteredUser;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class SendVerificationEmail implements ShouldQueue
{
    public function __construct(
        private SendAuthCode $action
    ) {}

    public function handle(RegisteredUser $event): void
    {
        $this->action->handle($event->user);
    }
}
