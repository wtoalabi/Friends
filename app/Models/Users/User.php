<?php

namespace App\Models\Users;


use App\Models\Images\Image;
use App\Models\Statuses\Status;
use App\Helpers\Users\Profileable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\Presenters\UserPresenter as Presentable;

class User extends Authenticatable
{
    use Notifiable, Profileable, Presentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'auth', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     public function setPasswordAttribute ($password){
         $this->attributes['password'] = bcrypt($password);
    }    
    
    public function images (){
         return $this->hasMany(Image::class);
    }

    public function albums (){
         return $this->hasMany(Album::class);
    }

    public function statuses (){
        return $this->hasMany(Status::class);
   }
   
   public function getRouteKeyName(){
    return 'email';
}
  
}
