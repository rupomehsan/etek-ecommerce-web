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

class OrderSuccessEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ETEK Order - ' . $this->order->order_id . ' - ' . $this->order->paid_status,
            from: new Address('sales@etek.com.bd', 'ETEK Enterprise'),
            tags: ['etek order'],
            replyTo: [
                new Address('support@etek.com.bd', 'ETEK Enterprise'),
            ],
            metadata: [
                'order_id' => $this->order->id,
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.order_success',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', 'frontend/images/etek_logo.png'),
        ];
    }
}
