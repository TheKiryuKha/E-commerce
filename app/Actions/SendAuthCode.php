<?php

declare(strict_types=1);

namespace App\Actions;

use App\Mail\AuthorizationCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

final readonly class SendAuthCode
{
    public function __construct(
        private readonly CreateAuthCode $action
    ) {}

    public function handle(User $user): void
    {
        DB::transaction(function () use ($user): void {

            Mail::to(
                $user->email
            )->send(new AuthorizationCodeMail(
                $this->action->handle($user)
            ));
        });
    }
}
