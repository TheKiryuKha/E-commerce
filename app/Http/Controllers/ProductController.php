<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateProduct;
use App\Actions\EditProduct;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use App\Queries\ProductQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class ProductController
{
    public function index(ProductQuery $query): AnonymousResourceCollection
    {
        $products = $query->get(Product::query());

        return ProductResource::collection($products->get());
    }

    public function store(StoreRequest $request, CreateProduct $action): ProductResource
    {
        Gate::authorize('create', Product::class);

        /** @var User $user */
        $user = auth()->user();

        $product = $action->handle($user, $request->toDto());

        return new ProductResource($product);
    }

    public function update(Product $product, UpdateRequest $request, EditProduct $action): ProductResource
    {
        Gate::authorize('edit', $product);

        $action->handle($product, $request->toDto());

        return new ProductResource($product);
    }

    public function show(Product $product, ProductQuery $query): ProductResource
    {
        $product = $query->get(Product::query()->where(
            'id',
            $product->id
        ));

        return new ProductResource($product->first());
    }
}
