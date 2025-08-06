<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $pdfContent;

    public function __construct($order, $pdfContent)
    {
        $this->order = $order;
        $this->pdfContent = $pdfContent;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hóa đơn #' . $this->order->order_code
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mail.invoice', // view blade của email
            with: [
                'order' => $this->order,
            ]
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn() => $this->pdfContent, "hoa-don-{$this->order->order_code}.pdf")
                ->withMime('application/pdf'),
        ];
    }
}
