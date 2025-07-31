<?php

declare(strict_types=1);

use App\Enums\HistoryStatus;
use App\Exports\HistoriesExport;
use App\Models\History;
use App\Models\Product;
use App\Models\User;

test('map', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $history = History::factory()
        ->for($user)
        ->for($product)
        ->create([
            'status' => HistoryStatus::Viewed,
            'time' => now()->subHour(),
        ]);

    $mapped = new HistoriesExport()->map($history);

    $this->assertEquals($history->id, $mapped[0]);
    $this->assertEquals($user->id, $mapped[1]);
    $this->assertEquals($product->id, $mapped[2]);
    $this->assertEquals('Просмотрено', $mapped[3]);
    $this->assertEquals('1 hour ago', $mapped[4]);
});
