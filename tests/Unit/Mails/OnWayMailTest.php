<?php

declare(strict_types=1);

use App\Mail\OnWayMail;
use App\Models\Invoice;
use Illuminate\Mail\Mailables\Address;

beforeEach(function () {
    $this->invoice = Invoice::factory()->onWay()->create();
    $this->mail = new OnWayMail($this->invoice);
});

test('envelope', function () {

    $envelope = $this->mail->envelope();

    expect($envelope->from)->toBeInstanceOf(Address::class)
        ->and($envelope->from->address)->toBe(config()->string('mail.from.address'))
        ->and($envelope->from->name)->toBe(config()->string('mail.from.name'))
        ->and($envelope->subject)->toBe('Your invoice is on the way!');
});

test('content', function () {
    expect($this->mail->content()->markdown)->toBe('mails.on-way');
});

it('has public invoice', function () {
    expect($this->mail->invoice)->toBeInstanceOf(Invoice::class);
});
