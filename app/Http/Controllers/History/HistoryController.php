<?php

declare(strict_types=1);

namespace App\Http\Controllers\History;

use App\Http\Resources\HistoryResource;
use App\Models\History;
use App\Queries\HistoryQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class HistoryController
{
    public function index(HistoryQuery $query): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', History::class);

        $histories = $query->get(History::query());

        return HistoryResource::collection(
            $histories->paginate(10)
        );
    }
}
