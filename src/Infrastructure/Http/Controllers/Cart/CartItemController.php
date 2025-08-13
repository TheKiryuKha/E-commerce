<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\CreateCartItem;
use App\Actions\DeleteCartItem;
use App\Http\Requests\Cart\CartItemRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;

final class CartItemController
{
    public function store(Cart $cart, CartItemRequest $request, CreateCartItem $action): CartResource
    {
        Gate::authorize('update', $cart);

        $action->handle($cart, $request->integer('product_id'));

        return new CartResource($cart);
    }

    public function destroy(Cart $cart, CartItemRequest $request, DeleteCartItem $action): CartResource
    {
        Gate::authorize('update', $cart);

        $action->handle($cart, $request->integer('product_id'));

        return new CartResource($cart);
    }
}
