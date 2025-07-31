<?php

declare(strict_types=1);

use App\DTOs\InvoiceDto;
use App\Enums\InvoiceStatus;

test('make', function () {
    $dto = InvoiceDto::make([
        'cost' => 100,
        'address' => 'Oskina',
        'user_telephone' => '+375447191945',
        'user_email' => 'kirillzuyeu@gmail.com',
        'status' => InvoiceStatus::OnWay,
    ]);

    expect($dto)
        ->cost->toBe(100)
        ->address->toBe('Oskina')
        ->user_telephone->toBe('+375447191945')
        ->user_email->toBe('kirillzuyeu@gmail.com')
        ->status->toBe(InvoiceStatus::OnWay);
});
