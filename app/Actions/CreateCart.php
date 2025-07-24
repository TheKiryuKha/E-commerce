<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateCart
{
    public function handle(User $user): Cart
    {
        return DB::transaction(function () use ($user) {

            $cart = new Cart([
                'amount' => 0,
                'products_amount' => 0,
            ]);

            $user->cart()->save($cart);

            return $cart;
        });
    }
}
