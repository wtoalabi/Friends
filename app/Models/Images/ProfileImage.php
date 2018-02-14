<?php

namespace App\Models\Images;

use App\Models\Users\User;
use App\Models\Images\Image;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    protected $fillable=['user_id', 'image_id', 'activated'];
    public function user (){
         return $this->belongsTo(User::class);
    }
    public function image (){
         return $this->belongsTo(Image::class);
    }

    public static function add($image){
        //dd($image);
        $profileImage = new static;
        $profileImage->create([
            'image_id' => $image->id,
        ]);
        //dd($profileImage->user());
        //$profileImage->user()->sync($image->id);
    }
}
