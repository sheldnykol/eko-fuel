<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Appointment $appointment, public string $customLink)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Νέα κράτηση πλυντηρίου: ' . substr($this->appointment->appointment_time, 0, 5) . ' ' . date('d/m', strtotime($this->appointment->appointment_date)),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_submitted',
        );
    }
}
