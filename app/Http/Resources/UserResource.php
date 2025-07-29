<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
final class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => 'user',
            'attributes' => [
                'name' => $this->resource->name,
                'email' => $this->resource->email,
                'role' => $this->resource->role,
                'status' => $this->resource->status,
                'created' => new DateResource(
                    $this->resource->created_at
                ),
            ],
            'relationships' => [
                // TODO
            ],
            'links' => [
                'parent' => route('api:users:index'),
                'self' => route('api:users:show', $this->resource),
            ],
        ];
    }
}
