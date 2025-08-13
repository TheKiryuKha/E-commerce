<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class ProductQuery
{
    /**
     * @param  Builder<Product>  $query
     * @return Builder<Product>
     */
    public function get(Builder $query): Builder
    {
        return QueryBuilder::for(
            $query
        )->allowedIncludes(
            []
        )->allowedFilters([
            AllowedFilter::exact('status'),
            AllowedFilter::operator('price', FilterOperator::DYNAMIC),
            AllowedFilter::operator('quantity', FilterOperator::DYNAMIC),
        ])->getEloquentBuilder();
    }
}
