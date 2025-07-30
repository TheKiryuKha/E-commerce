<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class AddProductToCartController
{
    public function __invoke(User $user, Product $product): CartResource
    {
        Gate::authorize('addProductsToCart', $user);

        $cart = $user->cart;

        $cart->products()->attach($product);

        $cart->update([
            'amount' => $cart->amount + $product->price,
            'products_amount' => $cart->products_amount + 1,
        ]);

        return new CartResource($cart);
    }
}
