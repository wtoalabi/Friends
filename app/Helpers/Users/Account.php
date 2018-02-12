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
            if($data->profileImage){
                static::processImage($user, $data);
            };
            //dd($user);
            return $user;
        });
 }

 public static function processImage($user, $data){
    $album = UserAlbum::create("Profile", $user);
    
    $image = (new ImageUpload($data->profileImage, $user, $album))
    ->process();
    ProfileImage::activate($image, $activate = true);

 }

}