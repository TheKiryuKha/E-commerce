<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class BannedUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly string $message
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config()->string('mail.from.address'),
                config()->string('mail.from.name')
            ),
            subject: 'Banned in application',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.banned-user',
        );
    }
}
