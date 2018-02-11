<?php

namespace App;

use App\User\Image;
use App\User\Album;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profileImage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /* public function setPasswordAttribute ($password){
         $this->attributes['password'] = bcrypt($password);
    } */
    public function images (){
         return $this->hasMany(Image::class);
    }

    public function albums (){
         return $this->hasMany(Album::class);
    }

    public function profile_image(){
        if($this->images->where('profile_image', 1)->first()){
            return $this->images->where('profile_image', 1)->first()->url;
    }
        return "default.jpg";
    }
}
