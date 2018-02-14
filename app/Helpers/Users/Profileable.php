<?php

namespace App\Helpers\Users;

use App\Models\Images\ProfileImage;

Trait Profileable{

    /* public function getUsernameAttribute ($username){    
    
        return str_replace($username, $username, "<a href='/user/$username'>@$username</a>");           
    } */
    public function setUsernameAttribute($username){
        $this->attributes['username'] = str_slug($username);
   }
   
    public function getRouteKeyName(){
         return 'username';
    }
    
    public function profile_images(){
        return $this->hasManyThrough(ProfileImage::class, Image::class);
    }
}