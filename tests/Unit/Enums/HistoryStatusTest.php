<?php

declare(strict_types=1);

use App\Enums\HistoryStatus;

test('all cases have a label', function () {
    collect(HistoryStatus::cases())->each(function (HistoryStatus $case) {
        expect($case->label())->toBeString();
    });
});
