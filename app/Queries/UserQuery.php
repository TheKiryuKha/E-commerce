<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class UserQuery
{
    /**
     * @param  Builder<User>  $query
     * @return Builder<User>
     */
    public function get(Builder $query): Builder
    {
        return QueryBuilder::for(
            $query
        )->allowedIncludes(
            []
        )->allowedFilters(
            AllowedFilter::exact('role')
        )->getEloquentBuilder();
    }
}
