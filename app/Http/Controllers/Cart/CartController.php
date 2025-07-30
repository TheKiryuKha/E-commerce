<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;

final class CartController
{
    public function show(Cart $cart): CartResource
    {
        Gate::authorize('view', $cart);

        return new CartResource($cart->load('products'));
    }
}
