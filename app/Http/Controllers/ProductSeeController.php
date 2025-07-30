<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\HistoryStatus;
use App\Http\Resources\ProductResource;
use App\Models\History;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

final class ProductSeeController
{
    public function __invoke(User $user, Product $product): ProductResource
    {
        Gate::authorize('seeProducts', $user);

        $history = History::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('status', HistoryStatus::Viewed)
            ->exists();

        if (! $history) {
            History::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'status' => HistoryStatus::Viewed,
                'time' => now(),
            ]);
        }

        return new ProductResource($product);
    }
}
