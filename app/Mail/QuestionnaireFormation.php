<?php

namespace JR_Formation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class QuestionnaireFormation extends Mailable
{
    use Queueable, SerializesModels;

    public $QuestionnaireFormation;
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
        $this->data = public_path() . '\storage\questionnaire_formation.xlsx';

        return $this->from('jrtformation.envoiautomatique@gmail.com')->view('emails.quest_formation')->attach($this->data);
    }
}
