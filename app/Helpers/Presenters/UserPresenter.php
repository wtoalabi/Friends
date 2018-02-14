<?php

namespace App\Helpers\Presenters;

/* use App\Models\Images\Album;
use App\Models\Images\Image;
use App\Models\Statuses\Status; */

Trait UserPresenter{

    public function profile_thumb(){
        if($image = $this->images->where('profile', 1)->first()){
            return $image->thumb;
            }
        return "default.jpg";
    }
    
    public function usernameSlug(){
        return "@$this->username";
    }
    
    public function usernameTag(){
        return str_replace($this->username, $this->username, "<a href='/user/@$this->username'>@$this->username</a>");           
    }

    public function latestStatus(){
        return $this->statuses()->latest()->first();
    }
    public function pageTitle(){
        if(preg_match('/[s]$/',$this->name)){
            return "$this->name"."'";
        }
        return $this->name."'s";
    }

}