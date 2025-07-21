<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\HistoryStatus;
use Illuminate\Database\Eloquent\Model;

final class History extends Model
{
    protected $casts = [
        'status' => HistoryStatus::class,
    ];
}
