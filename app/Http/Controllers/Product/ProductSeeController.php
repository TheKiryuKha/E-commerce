<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Actions\MarkProductAsViewed;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class ProductSeeController
{
    public function __invoke(
        User $user,
        Product $product,
        MarkProductAsViewed $action
    ): ProductResource {

        Gate::authorize('seeProducts', $user);

        if (! $user->isViewed($product)) {
            $action->handle($user, $product);
        }

        return new ProductResource($product);
    }
}
