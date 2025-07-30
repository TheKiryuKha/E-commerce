<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\Product;
use App\Actions\DeleteCartItem;

beforeEach(function () {
    $this->action = app(DeleteCartItem::class);
    $this->product = Product::factory()->create();
    $this->cart = Cart::factory()->create([
        'amount' => $this->product->price,
        'products_amount' => 1
    ]);
    
    $this->cart->products()->attach($this->product);
});

it('removes product from cart', function () {
    $action = app(DeleteCartItem::class);
    
    $action->handle($this->cart, $this->product);

    $this->assertFalse(
        $this->cart->products->contains($this->product)
    );
});

it("updates cart's data", function () {
    $action = app(DeleteCartItem::class);
    
    $action->handle($this->cart, $this->product);

    expect($this->cart)
        ->amount->toBe(0)
        ->products_amount->toBe(0);
});