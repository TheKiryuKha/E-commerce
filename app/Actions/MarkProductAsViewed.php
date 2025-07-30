<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\HistoryStatus;
use App\Models\History;
use App\Models\Product;
use App\Models\User;

final readonly class MarkProductAsViewed
{
    public function handle(User $user, Product $product): void
    {
        History::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => HistoryStatus::Viewed,
            'time' => now(),
        ]);
    }
}
