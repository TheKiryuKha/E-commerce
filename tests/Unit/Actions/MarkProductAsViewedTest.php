<?php

declare(strict_types=1);

use App\Actions\MarkProductAsViewed;
use App\Enums\HistoryStatus;
use App\Models\Product;
use App\Models\User;

it('saves users view in history', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $action = app(MarkProductAsViewed::class);

    $action->handle($user, $product);

    $this->assertDatabaseHas('histories', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'status' => HistoryStatus::Viewed,
    ]);
});
