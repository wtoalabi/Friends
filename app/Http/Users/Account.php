<?php

namespace App\Http\Users;

use App\User;
use App\User\Image;
use App\Http\Users\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class Account{
    public $user;

    static function persist($data){
        return DB::transaction(function() use($data){
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
            ]); 
            if($data->profileImage){
                $album = UserAlbums::createNew("Profile", $user->id);
                (new ImageUpload($data->profileImage, $user, $album, $profile = true))
                ->process();
            };

            return $user;
        });
 }
    
    /* static function processImage(UploadedFile $image, User $user){
        $image = new ImageUpload($image, $user);
    } */

}