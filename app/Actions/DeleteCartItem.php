<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final readonly class DeleteCartItem
{
    public function handle(Cart $cart, Product $product): void
    {
        DB::transaction(function () use ($cart, $product): void {
            
            $cart->products()->detach($product);

            $cart->update([
                'amount' => $cart->amount - $product->price,
                'products_amount' => $cart->products_amount - 1
            ]);
            
        });
    }
}