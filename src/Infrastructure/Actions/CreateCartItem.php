<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final readonly class CreateCartItem
{
    public function handle(Cart $cart, int $product_id): void
    {
        DB::transaction(function () use ($cart, $product_id): void {

            $product = Product::findOrFail($product_id);

            $cart->products()->attach($product);

            $cart->update([
                'amount' => $cart->amount + $product->price,
                'products_amount' => $cart->products_amount + 1,
            ]);
        });
    }
}
