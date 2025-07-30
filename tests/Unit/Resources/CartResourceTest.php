<?php

declare(strict_types=1);

use App\Http\Resources\CartResource;
use App\Http\Resources\DateResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

beforeEach(function () {
    $user = User::factory()->create();
    $this->cart = Cart::factory()->create(['user_id' => $user->id]);
    $product = Product::factory()->create();

    $this->cart->products()->attach($product);
});

test('toArray', function () {
    $this->cart->load('user', 'products');

    $resource = new CartResource($this->cart);

    expect($resource->toArray(new Request()))->toMatchArray([
        'id' => $this->cart->id,
        'type' => 'cart',
        'attributes' => [
            'amount' => $this->cart->amount,
            'products_amount' => $this->cart->products_amount,
            'created' => new DateResource(
                $this->cart->created_at
            ),
        ],
        'relations' => [
            'user' => new UserResource(
                $this->cart->user
            ),
            'products' => ProductResource::collection(
                $this->cart->products
            ),
        ],
        'links' => [
            'self' => route('api:carts:show', $this->cart),
        ],
    ]);
});
