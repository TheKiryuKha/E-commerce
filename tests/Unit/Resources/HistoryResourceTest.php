<?php

declare(strict_types=1);

use App\Http\Resources\DateResource;
use App\Http\Resources\HistoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\History;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

test('toArray', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();
    $history = History::factory()->create([
        'product_id' => $product->id,
        'user_id' => $user->id,
    ]);

    $resource = new HistoryResource($history);

    expect($resource->toArray(new Request()))->toMatchArray([
        'id' => $history->id,
        'type' => 'history',
        'product' => new ProductResource(
            $history->product
        ),
        'user' => new UserResource(
            $history->user
        ),
        'status' => $history->status,
        'time' => new DateResource(
            $history->time
        ),
    ]);
});
