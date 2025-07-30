<?php

declare(strict_types=1);

use App\Enums\HistoryStatus;
use App\Models\History;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->product = Product::factory()->create();
});

it('returns correct status code', function () {
    $response = $this->actingAs($this->user)->get(route(
        'api:products:see', [$this->user, $this->product]
    ));

    $response->assertStatus(200);
});

it('saves users watch to history', function () {

    $this->actingAs($this->user)->get(route(
        'api:products:see', [$this->user, $this->product]
    ));

    $this->assertDatabaseHas('histories', [
        'user_id' => $this->user->id,
        'product_id' => $this->product->id,
        'status' => HistoryStatus::Viewed,
    ]);
});

test('user cannot see one product twice', function () {
    $history = History::factory()->create([
        'user_id' => $this->user->id,
        'product_id' => $this->product->id,
        'status' => HistoryStatus::Viewed,
    ]);

    $this->actingAs($this->user)->get(route('api:products:see', [$this->user, $this->product]));

    $this->assertDatabaseCount('histories', 1);
});

test('user cannot save his view for other user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route(
        'api:products:see', [$this->user, $this->product]
    ));

    $response->assertStatus(403);
});
