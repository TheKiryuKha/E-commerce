<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\CreateCart;
use App\Events\RegisteredUser;

final readonly class CreateCartForUser
{
    public function __construct(
        private CreateCart $action
    ) {}

    public function handle(RegisteredUser $event): void
    {
        $this->action->handle($event->user);
    }
}
