<?php

namespace App\Helpers\Users;
use App\Models\Images\Album;
use App\Models\Images\Image;
use App\Models\Statuses\Status;
use App\Models\Images\ProfileImage;

Trait Profileable{

    /* public function getUsernameAttribute ($username){    
    
        return str_replace($username, $username, "<a href='/user/$username'>@$username</a>");           
    } */
    public function setUsernameAttribute($username){
        $this->attributes['username'] = str_slug($username);
   }

    public function profile_image(){
        if($this->profile_images->where('activated', 1)->first()){
            return $this->profile_images->where('activated', 1)->first();
            }
        return "default.jpg";
    }   
    public function getRouteKeyName(){
         return 'username';
    }
    public function usernameTag(){
        return str_replace($this->username, $this->username, "<a href='/user/$this->username'>@$this->username</a>");           
    }
    public function usernameSlug(){
        return $this->username;
    }
    public function profile_images(){
        return $this->hasMany(ProfileImage::class);
    }
}