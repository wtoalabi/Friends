<?php

namespace App\Models\Images;

use App\Models\Users\User;
use App\Models\Images\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    protected $fillable=['user_id', 'path'];
    public function user (){
         return $this->belongsTo(User::class);
    }
    public function image (){
         return $this->belongsTo(Image::class);
    }

    public static function add($imagePath,$userID){
        //dd($userID);
        $profileImage = new static;
        $profileImage->create([
            'path' => $imagePath,
            'user_id' => $userID,
        ]);
        //dd($profileImage->user());
        //$profileImage->user()->sync($image->id);
    }
}
