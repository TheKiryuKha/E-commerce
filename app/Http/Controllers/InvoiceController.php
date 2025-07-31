<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\EditInvoice;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Support\Facades\Gate;

final class InvoiceController
{
    public function update(Invoice $invoice, UpdateRequest $request, EditInvoice $action): InvoiceResource
    {
        Gate::authorize('edit', $invoice);

        $action->handle($invoice, $request->toDto());

        return new InvoiceResource($invoice);
    }
}
