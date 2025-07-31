<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\DB;

test('validation works', function () {
    $this->post(
        route('api:auth:send-code')
    )->assertInvalid([
        'email',
    ]);
});

test('creates authetication code', function () {
    $user = User::factory()->create();

    $this->post(
        route('api:auth:send-code'),
        ['email' => $user->email]
    )->assertStatus(200);

    $this->assertTrue(
        DB::table('auth_tokens')->where(
            'user_id',
            $user->id
        )->exists()
    );
});
