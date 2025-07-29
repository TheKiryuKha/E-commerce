<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Queries\ProductQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ProductController
{
    public function index(ProductQuery $query): AnonymousResourceCollection
    {
        $products = $query->get(Product::query());

        return ProductResource::collection($products->get());
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
