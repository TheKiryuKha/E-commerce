<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;

final class UserObserver implements ShouldQueueAfterCommit
{
    public function created(User $user): void
    {
        $cart = new Cart([
            'amount' => 0,
            'products_amount' => 0,
        ]);

        $user->cart()->save($cart);
    }
}
