<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Invoice $resource
 */
final class InvoiceResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'invoice',
            'attributes' => [
                'cost' => $this->resource->cost,
                'address' => $this->resource->address,
                'user_telephone' => $this->resource->user_telephone,
                'user_email' => $this->resource->user_email,
                'status' => $this->resource->status,
                'created' => new DateResource(
                    $this->resource->created_at
                ),
            ],
            'relations' => [
                'products' => ProductResource::collection(
                    $this->whenLoaded('products')
                ),
            ],
            'links' => [
                // TODO
            ],
        ];
    }
}
