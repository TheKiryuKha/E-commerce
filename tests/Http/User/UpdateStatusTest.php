<?php

declare(strict_types=1);

use App\Enums\UserStatus;
use App\Events\UserUpdatedStatus;
use App\Listeners\SendUserStatusEmail;
use App\Mail\BannedUserMail;
use App\Mail\UnbannedUserMail;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->user = User::factory()->create();
});

test('validation works', function () {
    $response = $this->actingAs($this->admin)
        ->patch(route('api:users:status:update', $this->user));

    $response->assertInvalid([
        'status',
    ]);
});

test('non admin cannot ban users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->patch(
        route('api:users:status:update', $this->admin),
        ['status' => 'banned']
    )->assertStatus(
        403
    );
});

test('admin can ban user', function () {
    Mail::fake();
    Event::fake();

    $response = $this->actingAs($this->admin)->patch(
        route('api:users:status:update', $this->user),
        [
            'status' => 'banned',
            'message' => 'You dont follow our rules',
        ]
    );

    $response->assertStatus(200);

    expect($this->user->refresh()->status)->toBe(UserStatus::Banned);

    Event::assertDispatched(UserUpdatedStatus::class, function (UserUpdatedStatus $event) {
        (new SendUserStatusEmail())->handle($event);

        return true;
    });

    Mail::assertQueued(BannedUserMail::class, function (BannedUserMail $mail) {
        $this->assertEquals($mail->envelope()->subject, 'Banned in application');
        $this->assertEquals($mail->content()->markdown, 'mails.banned-user');
        $this->assertEquals($this->user->email, $mail->to[0]['address']);
        $this->assertEquals($this->user->id, $mail->user->id);

        $this->assertEquals($mail->message, 'You dont follow our rules');

        return true;
    });
});

test('admin can unban user', function () {
    Mail::fake();
    Event::fake();
    $user = User::factory()->banned()->create();

    $response = $this->actingAs($this->admin)->patch(
        route('api:users:status:update', $user),
        ['status' => 'active']
    );

    $response->assertStatus(200);

    expect($user->refresh()->status)->toBe(UserStatus::Active);

    Event::assertDispatched(UserUpdatedStatus::class, function (UserUpdatedStatus $event) {
        (new SendUserStatusEmail())->handle($event);

        return true;
    });

    Mail::assertQueued(UnbannedUserMail::class, function (UnbannedUserMail $mail) use ($user) {
        $this->assertEquals($mail->envelope()->subject, 'Unbanned in application');
        $this->assertEquals($mail->content()->markdown, 'mails.unbanned-user');
        $this->assertEquals($user->email, $mail->to[0]['address']);
        $this->assertEquals($user->id, $mail->user->id);

        return true;
    });
});
