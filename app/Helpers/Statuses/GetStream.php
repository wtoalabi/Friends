<?php

namespace App\Helpers\Statuses;

use App\Models\Statuses\Status;
use Illuminate\Support\Facades\Auth;

class GetStream{

    public static function forProfile ($userID){
        $status = new static;
        $columnName = "profile_id";
        $userIDs = $userID;
        $command = "where";
        $statuses = $status->runQueryWith($columnName, $userIDs, $command);
        return $statuses;
    }
    public static function forHome(){
        $status = new static;
        $userIDs = $status->getIDs();
        $command = "wherein";
        $columnName = "user_id";

        $statuses = $status->runQueryWith($columnName, $userIDs, $command);
        return $statuses;
    }

    public function runQueryWith($columnName, $userIDs, $command){
        $statuses = Status::with(['user' => function($query){
            $query->with(['images'=>function($query){
                $query->where('profile', 1)->first();
            }]);
        }, 
        'resharedFrom'=>function($query){
            $query->with(['user','profileOwner']);
        },
        'likes','mood','comments','status_images','profileOwner'])
        ->withCount('comments','likes','reshares')
        ->$command($columnName, $userIDs)
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