<?php

declare(strict_types=1);

namespace App\Mail\V1;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class UnbannedUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config()->string('mail.from.address'),
                config()->string('mail.from.name')
            ),
            subject: 'Unbanned in application',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.unbanned-user',
        );
    }
}
