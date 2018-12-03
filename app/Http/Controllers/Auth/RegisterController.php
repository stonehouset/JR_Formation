<?php

namespace JR_Formation\Http\Controllers\Auth;

use JR_Formation\User;
use JR_Formation\Http\Controllers\Controller;
use JR_Formation\Mail\MailWhenUserIsRegister;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());

        return $request->all();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [

            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|numeric|min:0|max:3',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \JR_Formation\User
     */
    protected function create(array $data)
    {

        $user =  User::create([

            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'role' => $data['role'],
            'numero_telephone' => $data['numero_telephone'],
            'email' => $data['email'],
            'password' =>bcrypt($data['password']), 
        ]);

        $data = [

               'nom' => $data['nom'],
               'prenom' => $data['prenom'],
               'email' => $data['email'],
               'role' => $data['role'],
               'mdp' => $data['password']
            ];

        Mail::to($data['email'])->send(new MailWhenUserIsRegister($data));

        return $user;
    }
}
