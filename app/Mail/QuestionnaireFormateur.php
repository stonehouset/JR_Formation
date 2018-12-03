<?php

namespace JR_Formation\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;
 
class QuestionnaireFormateur extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Elements de contact
     * @var array
     */
    public $QuestionnaireFormateur;
 
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

        $this->data = public_path() . '\storage\questionnaire_formateur.xlsx';

        // $url = public_path() . '/storage\exports\questionnaire_formateur.xlsx'; 
        return $this->from('jrtformation.envoiautomatique@gmail.com')->view('emails.quest_formateur')->attach($this->data);

        
    }
}