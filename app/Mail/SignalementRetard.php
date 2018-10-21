<?php

namespace JR_Formation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignalementRetard extends Mailable
{
    use Queueable, SerializesModels;



    public $SignalementRetard;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('houselstein.thibaud.dev@gmail.com')->view('emails.signalement_retard')->with(['data' => $this->data]);
    }
}
