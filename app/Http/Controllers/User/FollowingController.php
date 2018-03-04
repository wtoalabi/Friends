<?php

namespace App\Http\Controllers\User;

use App\Helpers\Users\Followership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Exception\NotFoundException;

class FollowingController extends Controller
{
    public function followingStatus ($recipient){
        $status =  Auth::user()->isFollowing($recipient);
        return response(['status'=> $status]);
    }

    public function make ($id){
        $recipient = $id;
        $user = Auth::user();
        $status = $user->isFollowing($recipient);
        if($status == true){
            Followership::unfollow($user,$recipient);
            return response(['status'=>300]);
            
        }
        else{
            Followership::follow($user, $recipient);
            return response(['status'=>200]);

        }
    }
}
