<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Http', 'Unit', 'Console');

pest()->extend(Tests\TestCase::class)
        ->group('arch')
        ->in('Arch');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createAuthCode(App\Models\User $user, string $code)
{
    DB::table('auth_tokens')->insert([
        'user_id' => $user->id,
        'code' => $code,
        'expires_at' => now()->addMinutes(5),
    ]);
}

function createExpiredAuthCode(App\Models\User $user, string $code)
{
    DB::table('auth_tokens')->insert([
        'user_id' => $user->id,
        'code' => $code,
        'expires_at' => now()->subMinutes(5),
    ]);
}
