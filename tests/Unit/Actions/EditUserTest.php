<?php

declare(strict_types=1);

use App\Actions\EditUser;
use App\DTOs\UserDto;
use App\Models\User;

it('updates user name', function () {
    $user = User::factory()->create();
    $action = app(EditUser::class);

    $action->handle(
        $user,
        UserDto::make(['name' => 'Iamtired'])
    );

    expect($user->refresh()->name)->toBe('Iamtired');
});
