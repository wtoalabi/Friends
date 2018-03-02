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

    public function runQueryWith($column, $user, $command){
        $statuses = Status::with(['user' => function($query){
            $query->with(['images'=>function($query){
                $query->where('profile', 1)->first();
            }]);
        },'likes','mood','comments','status_images','profileOwner'])
        ->withCount('comments','likes','reshares')
        ->$command($column, $user)
        ->latest()->paginate(10);
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