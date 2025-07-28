<?php

declare(strict_types=1);
use App\Actions\EditUserRole;
use App\DTOs\UserDto;
use App\Enums\UserRole;
use App\Events\UserUpdatedRole;
use App\Models\User;

beforeEach(
    fn () => $this->action = app(EditUserRole::class)
);

it('updates user role from customer to vendor', function () {
    $user = User::factory()->create();

    $this->action->handle(
        $user,
        UserDto::make(['role' => UserRole::Vendor])
    );

    expect($user->refresh()->role)->toBe(UserRole::Vendor);
});

it('updates user role from vendor to customer', function () {
    $user = User::factory()->vendor()->create();

    $this->action->handle(
        $user,
        UserDto::make(['role' => UserRole::Customer])
    );

    expect($user->refresh()->role)->toBe(UserRole::Customer);
});

it('dispatches that users role has been updated', function () {
    Event::fake();
    $user = User::factory()->create();

    $this->action->handle(
        $user,
        UserDto::make(['role' => UserRole::Vendor])
    );

    Event::assertDispatched(UserUpdatedRole::class);
});
