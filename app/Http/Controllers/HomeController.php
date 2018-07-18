<?php

namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use JR_Formation\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('home', ['users' => $users]);
    }
}
