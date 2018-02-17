<?php

namespace App\Helpers\Users;

use App\Models\Users\User;
use App\Helpers\Image\UserAlbum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Helpers\Image\ImageUpload;
use App\Models\Images\ProfileImage;


class Account{
    public $user;

    static function persist($data){
        return DB::transaction(function() use($data){
            $user = User::create([
                'name' => $data->name,
                'username' => $data->username,
                'email' => $data->email,
                'password' => bcrypt($data->password),
            ]); 
                static::processImage($user, $data);        
            //dd($user);
            return $user;
        });
 }

 public static function processImage($user, $data){
    
    if($data->profileImage){
         $album = UserAlbum::create("Profile", $user);
         
         $thumbPath = (new ImageUpload($data->profileImage, $user, $album, $profile= true))
         ->process();
         ProfileImage::add($thumbPath,$user->id);
        }
        else{
            ProfileImage::add("default.jpg",$user->id);
        }
 }

}