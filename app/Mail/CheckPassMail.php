<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckPassMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;
    public $subjectline;

    public function __construct($title, $content, $subject = "Thong bao tu Ktech")
    {
        $this->title = $title;
        $this->content = $content;
        $this->subjectline = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectline,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.Password',
            with: [
                'title' => $this->title,
                'content' => $this->content,
                'subject' => $this->subjectline,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
