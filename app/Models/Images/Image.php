<?php

namespace App\Models\Images;



use App\Models\Users\User;
use App\Models\Images\Album;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id', 'album_id', 'full', 'thumb','profile','imageUUID'
    ];
    public function user (){
         return $this->belongsTo(User::class);
    }
    public function image(){
         return $this->belongsTo(Album::class);
    }
}
