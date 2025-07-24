<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\CreateCart;
use App\Events\RegisteredUser;

final class CreateCartForUser
{
    public function __construct(
        private readonly CreateCart $action
    ) {}

    public function handle(RegisteredUser $event): void
    {
        $this->action->handle($event->user);
    }
}
