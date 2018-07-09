<?php

namespace JR_Formation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Apprenant extends Model
{
    public function setDateAttribute( $value ) {

	  	$this->attributes['date_naissance'] = (new Carbon($value))->format('d/m/y');
	  	$this->attributes['debut_tutorat'] = (new Carbon($value))->format('d/m/y');
	  	$this->attributes['fin_tutorat'] = (new Carbon($value))->format('d/m/y');
	  	$this->attributes['date_CDI'] = (new Carbon($value))->format('d/m/y');

	}
    
}
