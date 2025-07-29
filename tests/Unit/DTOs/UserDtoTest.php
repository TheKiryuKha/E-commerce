<?php

declare(strict_types=1);

use App\DTOs\UserDto;
use App\Enums\UserRole;
use App\Enums\UserStatus;

beforeEach(function () {
    $this->data = [
        'name' => 'Vasiliy',
        'email' => 'Pupkin@mail.com',
        'role' => UserRole::Customer,
        'status' => UserStatus::Active,
    ];
});

test('make', function () {
    $dto = UserDto::make($this->data);

    expect($dto)->toBeInstanceOf(UserDto::class);

    expect($dto)
        ->name->toBe($this->data['name'])
        ->email->toBe($this->data['email'])
        ->role->toBe($this->data['role'])
        ->status->toBe($this->data['status']);
});

test('to array', function () {
    $dto = new UserDto(
        $this->data['name'],
        $this->data['role'],
        $this->data['status'],
        $this->data['email']
    );

    expect($dto->toArray())->toMatchArray($this->data);
});

test('to array not include null data', function () {
    $dto = new UserDto(
        $this->data['name'],
        null,
        null,
        $this->data['email']
    );

    expect($dto->toArray())->toMatchArray([
        'name' => $this->data['name'],
        'email' => $this->data['email'],
    ]);
});

test('withMail', function () {
    $dto = new UserDto(
        $this->data['name'],
        $this->data['role'],
        $this->data['status'],
        $this->data['email']
    );

    $new_dto = $dto->withEmail('new_email');

    expect($new_dto)->toBeInstanceOf(UserDto::class);

    expect($new_dto)
        ->name->toBe($this->data['name'])
        ->email->toBe('new_email')
        ->role->toBe($this->data['role'])
        ->status->toBe($this->data['status']);
});

test('withName', function () {
    $dto = new UserDto(
        $this->data['name'],
        $this->data['role'],
        $this->data['status'],
        $this->data['email']
    );

    $new_dto = $dto->withName('name');

    expect($new_dto)->toBeInstanceOf(UserDto::class);

    expect($new_dto)
        ->name->toBe('name')
        ->email->toBe($this->data['email'])
        ->role->toBe($this->data['role'])
        ->status->toBe($this->data['status']);
});
