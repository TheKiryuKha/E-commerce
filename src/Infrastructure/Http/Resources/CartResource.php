<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Cart $resource,
 */
final class CartResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'cart',
            'attributes' => [
                'amount' => $this->resource->amount,
                'products_amount' => $this->resource->products_amount,
                'products' => ProductResource::collection(
                    $this->resource->products
                ),
                'created' => new DateResource(
                    $this->resource->created_at
                ),
            ],
            'relations' => [
                'user' => new UserResource(
                    $this->whenLoaded('user')
                ),
            ],
            'links' => [
                'self' => route('api:carts:show', $this->resource),
            ],
        ];
    }
}
