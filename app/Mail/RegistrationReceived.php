<?php

namespace App\Mail;

use App\Models\Registration;
use App\Services\MasterclassCalendar;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationReceived extends Mailable
{
    use Queueable, SerializesModels;

    private string $icsContent;

    public function __construct(
        public Registration $registration,
    ) {
        $this->registration->loadMissing('participants');
        $this->icsContent = MasterclassCalendar::icsFor($this->registration);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Received — Inclusive by Design ('.$this->registration->reference.')',
            replyTo: [
                new Address(
                    config('mail.secretariat.address', 'info@asnenafrica.org'),
                    config('mail.secretariat.name', 'Masterclass Secretariat'),
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-received',
        );
    }

    /** @return array<int, Attachment> */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->icsContent, 'Inclusive-by-Design-Masterclass.ics')
                ->withMime('text/calendar; charset=UTF-8; method=PUBLISH'),
        ];
    }

}
