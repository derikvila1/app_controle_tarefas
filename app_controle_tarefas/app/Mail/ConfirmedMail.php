<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Visita;

class ConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $visita;

      /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Visita $visita)
    {
        $this->visita = $visita;

      
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     public function build()
            {
                return $this->markdown('emails.confirmed')->subject('Visita confirmada');
            }
}