<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

it('deletes all expired codes, not current', function () {
    $user = User::factory()->create();

    createExpiredAuthCode($user, '11111');
    createExpiredAuthCode($user, '12111');
    createExpiredAuthCode($user, '13111');

    createAuthCode($user, '12345');

    Artisan::call('auth:clear-codes');

    $this->assertDatabaseCount('auth_tokens', 1);
});
