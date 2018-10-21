<?php

namespace JR_Formation;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
	public $timestamps = false;
	
    public function setDateAttribute( $value ) {

	  	$this->attributes['date_jour'] = (new Carbon($value))->format('d/m/y');

	}
}
