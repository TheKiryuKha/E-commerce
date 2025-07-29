<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\User;
use App\Queries\ProductQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class UserProductsController
{
    public function __invoke(User $user, ProductQuery $query): AnonymousResourceCollection
    {
        $products = $query->get($user->products()->getQuery());

        return ProductResource::collection($products->get());
    }
}
