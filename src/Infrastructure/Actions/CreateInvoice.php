<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\InvoiceDto;
use App\Enums\InvoiceStatus;
use App\Events\NewInvoice;
use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

final readonly class CreateInvoice
{
    public function handle(Cart $cart, InvoiceDto $dto): Invoice
    {
        return DB::transaction(function () use ($cart, $dto): Invoice {

            $invoice = Invoice::create([
                ...$dto->toArray(),
                'customer_id' => $cart->user_id,
                'cost' => $cart->amount,
                'user_email' => $cart->user->email,
                'status' => InvoiceStatus::Paid,
            ]);

            $invoice->products()->sync($cart->products);

            NewInvoice::dispatch($invoice);

            return $invoice;
        });
    }
}
