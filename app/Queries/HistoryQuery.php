<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\History;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class HistoryQuery
{
    /**
     * @param  Builder<History>  $query
     * @return Builder<History>
     */
    public function get(Builder $query): Builder
    {
        return QueryBuilder::for(
            $query
        )->allowedFilters([
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('product_id'),
            AllowedFilter::exact('status'),
        ])->getEloquentBuilder();
    }
}
