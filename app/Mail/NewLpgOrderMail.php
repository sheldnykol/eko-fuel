<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\LpgOrder;

class NewLpgOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(LpgOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Νέα Παραγγελία Υγραερίου (LPG) - EKO')
                    ->view('emails.new_lpg_order');
    }
}