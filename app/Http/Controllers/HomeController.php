<?php

namespace App\Http\Controllers;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\Registration\UserRegistered;

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
        //flash('Welcome Aboard!');       
        //session()->flash('flash_notification', "YEAH!");
        //flash('Account Created!', 'warning');
        //dd(session()->all());
        //event(new UserRegistered(Auth::user()));
        return view('home');
    }
}
