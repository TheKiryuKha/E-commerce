<?php

declare(strict_types=1);

use App\Actions\CreateInvoice;
use App\DTOs\InvoiceDto;
use App\Enums\HistoryStatus;
use App\Enums\InvoiceStatus;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->vendor = User::factory()->vendor()->create();

    $this->product = Product::factory()->create();

    $this->cart = Cart::factory()->create([
        'user_id' => $this->user->id,
        'amount' => $this->product->price,
    ]);

    $this->cart->products()->save($this->product);

    $this->dto = InvoiceDto::make([
        'vendor_id' => $this->vendor->id,
        'address' => 'Oskina',
        'user_telephone' => '8927',
    ]);
});

it("create's invoice", function () {
    $action = app(CreateInvoice::class);

    $action->handle($this->cart, $this->dto);

    $this->assertDatabaseHas('invoices', [
        'customer_id' => $this->user->id,
        'vendor_id' => $this->dto->vendor_id,
        'cost' => $this->product->price,
        'address' => 'Oskina',
        'user_telephone' => '8927',
        'user_email' => $this->user->email,
        'status' => InvoiceStatus::Paid,
    ]);
});

it('returns invoice', function () {
    $action = app(CreateInvoice::class);

    $invoice = $action->handle($this->cart, $this->dto);

    expect($invoice)->toBeInstanceOf(Invoice::class);
});

it("save's users purchase in history", function () {
    $action = app(CreateInvoice::class);

    $action->handle($this->cart, $this->dto);

    $this->assertDatabaseHas('histories', [
        'user_id' => $this->user->id,
        'product_id' => $this->product->id,
        'status' => HistoryStatus::Purchased,
    ]);
});
