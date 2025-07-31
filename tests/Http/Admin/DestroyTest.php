<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->user = User::factory()->create();
});

test('non admin cannot delete admin', function () {
    $this->actingAs($this->user)->delete(route(
        'api:users:admins:delete',
        $this->admin
    ))->assertStatus(
        403
    );
});

test('admin can delete himself', function () {
    $this->actingAs($this->admin)->delete(route(
        'api:users:admins:delete',
        $this->admin
    ))->assertStatus(204);

    $this->assertDatabaseMissing('users', [
        'user_id' => $this->admin->id,
    ]);
});

test('admin can delete other admin', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($this->admin)->delete(route(
        'api:users:admins:delete',
        $admin
    ))->assertStatus(204);

    $this->assertDatabaseMissing('users', [
        'user_id' => $admin->id,
    ]);
});
