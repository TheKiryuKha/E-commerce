<?php

declare(strict_types=1);

namespace App\Queries;

use Illuminate\Support\Facades\DB;

final readonly class IsAuthCodeUnique
{
    public function handle(string $code): bool
    {
        return DB::table('auth_tokens')
            ->where('code', $code)
            ->lockForUpdate()
            ->exists();
    }
}
