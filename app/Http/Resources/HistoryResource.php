<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read History $resource
 */
final class HistoryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->load('user', 'product');

        return [
            'id' => $this->resource->id,
            'type' => 'history',
            'product' => new ProductResource(
                $this->resource->product
            ),
            'user' => new UserResource(
                $this->resource->user
            ),
            'status' => $this->resource->status,
            'time' => new DateResource(
                $this->resource->time
            ),
        ];
    }
}
