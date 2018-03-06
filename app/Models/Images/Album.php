<?php

namespace App\Models\Images;


use App\Models\Users\User;
use App\Models\Images\Image;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name', 'user_id', 'folderID', 'description'
    ];
    public function user (){
        return $this->belongsTo(User::class);
   }
   public function images (){
    return $this->hasMany(Image::class);
}
}
