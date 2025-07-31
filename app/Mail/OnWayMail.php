<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class OnWayMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Invoice $invoice
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config()->string('mail.from.address'),
                config()->string('mail.from.name')
            ),
            subject: 'Your invoice is on the way!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.on-way',
        );
    }
}
