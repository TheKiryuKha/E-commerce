<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Queries\IsAuthCodeUnique;
use Illuminate\Support\Facades\DB;

final readonly class CreateAuthCode
{
    public function __construct(
        private readonly IsAuthCodeUnique $query
    ) {}

    public function handle(User $user): string
    {
        return DB::transaction(function () use ($user): string {
            do {
                $code = (string) random_int(10000, 99999);

            } while ($this->query->handle($code));

            DB::table('auth_tokens')->insert([
                'code' => $code,
                'user_id' => $user->id,
                'expires_at' => now()->addMinutes(5),
            ]);

            return $code;
        });
    }
}
