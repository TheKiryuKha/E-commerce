<?php

declare(strict_types=1);

use App\Http\Resources\DateResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\ProductResource;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

test('to array', function () {
    $invoice = Invoice::factory()->create();
    $product = Product::factory()->create();
    $invoice->products()->attach($product);

    $invoice->load('products');

    $resource = new InvoiceResource($invoice);

    expect($resource->toArray(new Request()))->toMatchArray([
        'id' => $invoice->id,
        'type' => 'invoice',
        'attributes' => [
            'cost' => $invoice->cost,
            'address' => $invoice->address,
            'user_telephone' => $invoice->user_telephone,
            'user_email' => $invoice->user_email,
            'status' => $invoice->status,
            'created' => new DateResource(
                $invoice->created_at
            ),
        ],
        'relations' => [
            'products' => ProductResource::collection(
                $invoice->products
            ),
        ],
        'links' => [
            // TODO
        ],
    ]);
});
