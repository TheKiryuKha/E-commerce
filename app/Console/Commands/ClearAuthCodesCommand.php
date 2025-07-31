<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class ClearAuthCodesCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'auth:clear-codes';

    /**
     * @var string
     */
    protected $description = 'Deletes all expired authentication codes';

    public function handle(): void
    {
        $codes = DB::table('auth_tokens')->where(
            'expires_at', '<', now()
        )->delete();

        $this->info(sprintf(
            '%d expired codes have been deleted',
            $codes
        ));
    }
}
