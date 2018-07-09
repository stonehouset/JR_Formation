<?php

namespace JR_Formation;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    public function setDateAttribute( $value ) {

	  	$this->attributes['date_debut'] = (new Carbon($value))->format('d/m/y');
	  	$this->attributes['date_fin'] = (new Carbon($value))->format('d/m/y');
	}
    
}
