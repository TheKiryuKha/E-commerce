<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Queries\CartQuery;
use Illuminate\Support\Facades\Gate;

final class CartController
{
    public function show(Cart $cart, CartQuery $query): CartResource
    {
        Gate::authorize('view', $cart);

        $cart = $query->get(Cart::query()->where('id', $cart->id));

        return new CartResource($cart->first());
    }
}
