<?php

namespace JR_Formation\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;
 
class ImpactFormation extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Elements de contact
     * @var array
     */
    public $ImpactFormation;
 
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

        $this->data = public_path() . '\storage\impact_formation.xlsx';

        // $url = public_path() . '/storage\exports\questionnaire_formateur.xlsx'; 
        return $this->from('houselstein.thibaud.dev@gmail.com')->view('emails.impact_formation')->attach($this->data);

        
    }
}