<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class GetUserByCode
{
    public function get(string $code): User
    {
        $id = DB::table('auth_tokens')
            ->where('code', $code)
            ->value('user_id');

        return User::findOrFail($id)->firstOrFail();
    }
}
