<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\DeleteCartItem;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CartRemoveController
{
    public function __invoke(
        User $user,
        Product $product,
        DeleteCartItem $action
    ): CartResource {
        
        Gate::authorize('removeProductsFromCart', $user);

        $action->handle($user->cart, $product);

        return new CartResource($user->cart);
    }
}
