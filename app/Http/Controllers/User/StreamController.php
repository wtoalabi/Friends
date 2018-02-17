<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
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
        $userIDs = $this->getIDs();
        $statuses = Status::with(['user'=> function($query){
            $query->with('profile_image');
        },'mood'])
        ->whereIn('user_id', $userIDs)
        ->latest()->paginate(5);
        return view('users.stream',compact('statuses'));
    }

    public function getIDs (){
        $loggedInUserID[] = Auth::user()->id;
        $followedUsers = Auth::user()->following
        ->pluck('id')->toArray();
        $allUsers = array_merge($loggedInUserID, $followedUsers);
        return $allUsers;
    }
}
