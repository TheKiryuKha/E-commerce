<?php

use App\Enums\UserRole;
use App\Events\RegisteredUser;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(fn () => $this->admin = User::factory()->admin()->create());

test('validation works', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('api:users:admins:store'));

    $response->assertInvalid([
        'email'
    ]);
});

test('non admin cannot create admin', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route(
            'api:users:admins:store',
            ['email' => 'fakemail@mail.com']
        ))->assertStatus(
            403
        );
});

test('admin can create new admin', function () {
    Event::fake();
    
    $this->actingAs($this->admin)->post(route(
        'api:users:admins:store',
        ['email' => 'test@mail.com']
    ))->assertStatus(
        201
    );

    $user = User::where('email', 'test@mail.com')->first();

    expect($user)
        ->name->toBe('test@mail.com')
        ->role->toBe(UserRole::Admin);

    Event::assertDispatched(RegisteredUser::class, function (RegisteredUser $event) use ($user) {
        return $event->user->id === $user->id;
    });
});