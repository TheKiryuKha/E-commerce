<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\AddProductToCart;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class AddProductToCartController
{
    public function __invoke(
        User $user,
        Product $product,
        AddProductToCart $action
    ): CartResource {

        Gate::authorize('addProductsToCart', $user);

        $action->handle($user->cart, $product);

        return new CartResource($user->cart);
    }
}
