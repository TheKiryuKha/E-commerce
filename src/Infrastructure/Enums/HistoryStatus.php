<?php

declare(strict_types=1);

namespace App\Enums;

enum HistoryStatus: string
{
    case Viewed = 'viewed';
    case Purchased = 'purchased';

    public function label(): string
    {
        return match ($this) {
            self::Viewed => 'Просмотрено',
            self::Purchased => 'Куплено'
        };
    }
}
