<?php

declare(strict_types=1);

use App\Enums\UserStatus;
use App\Events\V1\UserUpdatedStatus;
use App\Mail\V1\BannedUserMail;
use App\Mail\V1\UnbannedUserMail;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->user = User::factory()->create();
});

test('validation works', function () {
    $response = $this->actingAs($this->admin)
        ->patch(route('api:v1:users:updateStatus', $this->user));

    $response->assertInvalid([
        'status',
    ]);
});

test('non admin cannot ban users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->patch(
        route('api:v1:users:updateStatus', $this->admin),
        ['status' => 'banned']
    )->assertStatus(
        403
    );
});

test('admin can ban user', function () {
    Mail::fake();
    Event::fake();

    $response = $this->actingAs($this->admin)->patch(
        route('api:v1:users:updateStatus', $this->user),
        ['status' => 'banned']
    );

    $response->assertStatus(200);

    expect($this->user->refresh()->status)->toBe(UserStatus::Banned);

    Event::assertDispatched(UserUpdatedStatus::class);
    // Mail::assertSent(BannedUserMail::class);
});

test('admin can unban user', function () {
    Mail::fake();
    Event::fake();
    Bus::fake();
    $user = User::factory()->banned()->create();

    $response = $this->actingAs($this->admin)->patch(
        route('api:v1:users:updateStatus', $user),
        ['status' => 'active']
    );

    $response->assertStatus(200);

    expect($user->refresh()->status)->toBe(UserStatus::Active);

    Event::assertDispatched(UserUpdatedStatus::class);
    // Mail::assertSent(UnbannedUserMail::class);
});
