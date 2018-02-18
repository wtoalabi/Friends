<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Statuses extends Controller
{
    public function index (){
        $userIDs = $this->getIDs();
        $statuses = Status::with(['user' => function($query){
            $query->with('profile_image');
        },'mood'])
        ->whereIn('user_id', $userIDs)
        ->latest()->paginate(5);
        return $statuses;
    }

    public function getIDs (){
        $loggedInUserID[] = Auth::user()->id;
        $followedUsers = Auth::user()->following
        ->pluck('id')->toArray();
        $allUsers = array_merge($loggedInUserID, $followedUsers);
        return $allUsers;
    }

}
