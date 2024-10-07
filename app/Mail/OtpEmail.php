<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $subject;
    public function __construct($otp, $subject)
    {
        $this->otp = $otp;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            from: new Address('sales@etek.com.bd', 'ETEK Enterprise'),
            tags: ['etek order'],
            replyTo: [
                new Address('support@etek.com.bd', 'ETEK Enterprise'),
            ],
            metadata: [
                'otp' => $this->otp,
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.otp',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', 'frontend/images/etek_logo.png'),
        ];
    }
}
