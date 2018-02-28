<?php

namespace App\Helpers\Users;

use App\Models\Users\User;
use App\Models\Images\Image;
use App\Models\Images\ProfileImage;

Trait Profileable{

   
    public function setUsernameAttribute($username){
        $this->attributes['username'] = str_slug($username);
   }
   
    public function getRouteKeyName(){
         return 'username';
    }
    
    /* public function profile_image(){
        return $this->hasOne(ProfileImage::class);
    } */
    public function followers(){
        return $this->belongsToMany(User::class, 'follows', 'follow_id', 'user_id')->withTimestamps();
    }
    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_id')->withTimestamps();
    }
    public function isFollowing($followID){
        if($this->following()->where('follow_id', $followID)->first()){
            return true;
        }
    return false;
    }
}