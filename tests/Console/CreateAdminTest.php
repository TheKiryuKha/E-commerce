<?php

declare(strict_types=1);

use App\Console\Commands\CreateAdminCommand;
use App\Enums\UserRole;

it('creates admin with provided info', function () {
    $this->artisan(CreateAdminCommand::class)
        ->expectsQuestion("What's the 1 admin name?", 'Admin1')
        ->expectsQuestion("What's the 1 admin email?", 'admin1@mail.com')
        ->assertExitCode(0);

    $this->assertDatabaseHas('users', [
        'name' => 'Admin1',
        'email' => 'admin1@mail.com',
        'role' => UserRole::Admin,
    ]);
});

it('creates 2 admin with provided info', function () {
    $this->artisan(CreateAdminCommand::class, ['admins' => 2])
        ->expectsQuestion("What's the 1 admin name?", 'Admin1')
        ->expectsQuestion("What's the 1 admin email?", 'admin1@mail.com')
        ->expectsQuestion("What's the 2 admin name?", 'Admin2')
        ->expectsQuestion("What's the 2 admin email?", 'admin2@mail.com')
        ->assertExitCode(0);

    $this->assertDatabaseHas('users', [
        'name' => 'Admin1',
        'email' => 'admin1@mail.com',
        'role' => UserRole::Admin,
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'Admin2',
        'email' => 'admin2@mail.com',
        'role' => UserRole::Admin,
    ]);
});
