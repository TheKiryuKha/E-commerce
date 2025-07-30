<?php

declare(strict_types=1);

use App\Http\Resources\DateResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

test('toArray', function () {
    $product = Product::factory()->create();

    $resource = new ProductResource($product);

    expect($resource->toArray(new Request()))->toMatchArray([
        'id' => $product->id,
        'type' => 'product',
        'attributes' => [
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
            'status' => $product->status,
            'quantity' => $product->quantity,
            'created' => new DateResource(
                $product->created_at
            ),
        ],
        'relations' => [],
        'links' => [
            'parent' => route('api:products:index'),
            'self' => route('api:products:show', $product),
        ],
    ]);
});
