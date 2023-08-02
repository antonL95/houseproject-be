<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly User $user)
    {
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome',
        );
    }


    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
