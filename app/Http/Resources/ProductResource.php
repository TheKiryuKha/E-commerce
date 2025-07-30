<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
final class ProductResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'product',
            'attributes' => [
                'title' => $this->resource->title,
                'description' => $this->resource->description,
                'price' => $this->resource->price,
                'status' => $this->resource->status,
                'quantity' => $this->resource->quantity,
                'created' => new DateResource(
                    $this->resource->created_at
                ),
            ],
            'relations' => [],
            'links' => [
                'parent' => route('api:products:index'),
                'self' => route('api:products:show', $this->resource),
            ],
        ];
    }
}
