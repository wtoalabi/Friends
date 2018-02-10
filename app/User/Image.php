<?php

namespace App\User;

use App\User;
use App\User\Album;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id', 'album_id', 'profile_image', 'url'
    ];
    public function user (){
         return $this->belongsTo(User::class);
    }
    public function image(){
         return $this->belongsTo(Album::class);
    }
}
