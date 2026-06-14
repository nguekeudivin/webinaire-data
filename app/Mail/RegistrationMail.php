<?php

namespace App\Mail;

use App\Models\Prospect;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Prospect $prospect,
        public string $type = 'prospect'
    ) {}

    public function build(): self
    {
        if ($this->type === 'admin') {
            return $this
                ->subject('Nouvelle inscription - Master of Data')
                ->view('emails.registration_admin');
        }

        return $this
            ->subject('Votre inscription est confirmée')
            ->view('emails.registration_prospect');
    }
}
