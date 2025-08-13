<?php

declare(strict_types=1);

use App\Actions\CreateUser;
use App\DTOs\UserDto;
use App\Enums\UserRole;
use App\Events\RegisteredUser;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    $this->user_data = [
        'name' => 'test',
        'role' => UserRole::Customer,
        'email' => 'test@mail.com',
        'password' => 'test_password',
    ];
    $this->dto = UserDto::make($this->user_data);
});

it("create's user", function () {
    $action = app(CreateUser::class);

    $action->handle($this->dto);

    expect(User::first())
        ->name->toBe('test')
        ->email->toBe('test@mail.com')
        ->role->toBe(UserRole::Customer);
});

it("dispatche's about new registered user", function () {
    Event::fake();
    $action = app(CreateUser::class);

    $action->handle($this->dto);

    Event::assertDispatched(RegisteredUser::class);
});
