<?php

declare(strict_types=1);

use App\Console\Commands\ClearAuthCodesCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(
    ClearAuthCodesCommand::class
)->everyFiveMinutes();
