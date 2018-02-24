<?php

namespace App\Helpers\Users;

use App\Models\Users\User;
use App\Helpers\Image\UserAlbum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Helpers\Image\ImageUpload;
use App\Models\Images\ProfileImage;
use App\Helpers\Image\FolderIdsOnRedis;


class Account{
    public $user;

    static function persist($data){
        return DB::transaction(function() use($data){
            $user = User::create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'username' => $data->username,
                'email' => $data->email,
                'password' => bcrypt($data->password),
            ]); 
            if($data->profileImage){
                static::processProfileImage($user, $data);        
            }
            FolderIdsOnRedis::CreateDefaultFolders($user->id);
            return $user;
        });
 }

 public static function processProfileImage($user, $data){
            
         (new ImageUpload($data->profileImage, $user, $folderID= 1, $album=null, $profile= true))
         ->process();
        }

}