<?php

namespace App\Helpers\Users;

use App\Models\Users\User;
use App\Events\User\UserFollowed;
use App\Events\User\UserUnFollowed;
use Illuminate\Support\Facades\Auth;

class Followership{
    
    public static function unfollow ($user, $recipient){
        return $user->following()->detach($recipient);        
        //event (new UserUnFollowed());
        
    }
    
    public static function follow ($user, $recipient){
        return $user->following()->attach($recipient);
        //event (new UserFollowed($this->userToFollow));
    }
}