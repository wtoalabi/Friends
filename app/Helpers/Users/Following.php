<?php

namespace App\Helpers\Users;

use App\Models\Users\User;
use App\Events\User\UserFollowed;
use App\Events\User\UserUnFollowed;
use Illuminate\Support\Facades\Auth;

class Following{
    protected $user;
    protected $userToFollow;
    protected $followID;

    public function __construct ($users){
        $this->followID = $users['follow_id'];
        $this->user = $users['user'];

    }
    public function make(){
        $this->userToFollow = User::find($this->followID);
        if($this->user->isFollowing($this->followID)){
            $this->unfollow();
            return response(['message'=> 'Unfollowed!', 300]);
        }
        $this->follow();
        return response(['message'=> 'Followed!', 200]);     
    }
    
    public function unfollow (){
        $user = $this->userToFollow;
        $this->user->following()->detach($this->followID);
        event (new UserUnFollowed($user));
        return ;
       
    }
    
    public function follow (){
        $this->user->following()->attach($this->userToFollow);
        event (new UserFollowed($this->userToFollow));
        return ;
    }
}