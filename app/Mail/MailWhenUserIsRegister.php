<?php

namespace JR_Formation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailWhenUserIsRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->data = $data;

        $this->subject('Création de profil JRT_Formation');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('houselstein.thibaud.dev@gmail.com')->view('emails.bienvenue_utilisateur')->with(['data' => $this->data]);
    }
}
