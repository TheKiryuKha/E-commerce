<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class GetUser
{
    public function get(User $user): ?User
    {
        return QueryBuilder::for(
            User::query()->where('id', $user->id)
        )->allowedIncludes(
            []
        )->first();
    }
}
