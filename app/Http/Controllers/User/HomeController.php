<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;

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
        //$statuses = Status::paginate(10)->get()->with('user');
        $statuses = Status::with('user')->latest()->paginate(10);
        return view('users.home',compact('statuses'));
    }
}
