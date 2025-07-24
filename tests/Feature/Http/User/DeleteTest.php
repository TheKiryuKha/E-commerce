<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;

it('deletes user', function () {
    $user = User::factory()->vendor()->create();
    Cart::factory()->for($user)->create();
    $product = Product::factory()->for($user)->create();

    $invoices = Invoice::factory(3)->for($user, 'vendor')->create();

    foreach ($invoices as $invoice) {
        $invoice->products()->save($product);
    }

    $this->actingAs($user)
        ->delete(route('api:v1:users:delete', $user))
        ->assertStatus(204);

    $this->assertFalse(
        User::where(
            'id',
            $user->id
        )->exists()
    );

    expect(Cart::count())->toBe(0);

    expect(Product::count())->toBe(0);

    expect(Invoice::count())->toBe(3);
});

test('user cannot exit, if he has unprocessed orders', function () {
    $user = User::factory()->create();
    $invoice = Invoice::factory()->paid()->make();

    $user->invoices()->save($invoice);

    $this->actingAs($user)
        ->delete(route('api:v1:users:delete', $user))
        ->assertStatus(403);
});
