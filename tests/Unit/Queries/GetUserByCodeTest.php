<?php

declare(strict_types=1);

use App\Models\User;
use App\Queries\GetUserByCode;
use Illuminate\Database\Eloquent\ModelNotFoundException;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->query = app(GetUserByCode::class);
});

it('returns user by code', function () {
    createAuthCode($this->user, '12345');

    $user = $this->query->get('12345');

    expect($user)->toBeInstanceOf(User::class);
});

it('returns exception if code non-exists', function () {
    $this->expectException(ModelNotFoundException::class);

    $this->query->get('12345');
});
