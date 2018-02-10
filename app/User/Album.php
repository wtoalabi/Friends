<?php

namespace App\User;

use App\User;
use App\User\Image;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];
    public function user (){
        return $this->belongsTo(User::class);
   }
   public function images (){
    return $this->hasMany(Image::class);
}
}
