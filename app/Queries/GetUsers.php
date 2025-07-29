<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class GetUsers
{
    public function get(): LengthAwarePaginator
    {
        return QueryBuilder::for(
            User::query()
        )->allowedIncludes(
            []
        )->allowedFilters(
            AllowedFilter::exact('role')
        )->paginate(10);
    }
}
