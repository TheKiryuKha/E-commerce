<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateInvoice;
use App\Actions\EditInvoice;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Support\Facades\Gate;

final class InvoiceController
{
    public function store(Cart $cart, StoreRequest $request, CreateInvoice $action): InvoiceResource
    {
        Gate::authorize('buy', $cart);

        $invoice = $action->handle($cart, $request->toDto());

        return new InvoiceResource($invoice);
    }

    public function update(Invoice $invoice, UpdateRequest $request, EditInvoice $action): InvoiceResource
    {
        Gate::authorize('edit', $invoice);

        $action->handle($invoice, $request->toDto());

        return new InvoiceResource($invoice);
    }
}
