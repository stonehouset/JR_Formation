<?php

namespace JR_Formation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class CompteRenduFormateur extends Mailable
{
    use Queueable, SerializesModels;

    public $CompteRenduFormateur;
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
        $this->data = public_path() . '\storage\compte_rendu_formateur.xlsx';

        return $this->from('jrtformation.envoiautomatique@gmail.com')->view('emails.compte_rendu_formateur')->attach($this->data);
    }
}
