<?php

namespace JR_Formation;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'role', 'numero_telephone', 'email', 'password',
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','password',
    ];


    public function isAdmin()
    {

    return $this->admin; // this looks for an admin column in your users table
    
    }

    public function setPasswordAttribute($password)
    {   

        $this->attributes['password'] = bcrypt($password);

    }

    public function initials()
    {
        $initials = Auth::user();

        return $initials;

        return view('layouts.menu', ['initials' => $initials]);
    }

    // public function Apprenant()
    // {
    // return $this->hasOne('JR_Formation\Apprenant');
    // }
}
