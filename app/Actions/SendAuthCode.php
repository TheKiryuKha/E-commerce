<?php

declare(strict_types=1);

namespace App\Actions;

use App\Mail\AuthorizationCodeMail;
use App\Models\User;
use App\Queries\IsAuthCodeUnique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

final readonly class SendAuthCode
{
    public function __construct(
        private readonly IsAuthCodeUnique $query
    ) {}

    public function handle(User $user)
    {
        DB::transaction(function () use ($user) {
            do {
                $code = (string) random_int(10000, 99999);

            } while ($this->query->handle($code));

            DB::table('auth_tokens')->insert([
                'code' => $code,
                'user_id' => $user->id,
                'expires_at' => now()->addMinutes(5),
            ]);

            Mail::to($user->email)->send(new AuthorizationCodeMail($code));
        });
    }
}
