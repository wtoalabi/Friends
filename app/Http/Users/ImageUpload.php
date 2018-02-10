<?php
namespace App\Http\Users;

use App\User;
use App\User\Album;
use App\User\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageUpload{
    protected $name;
    protected $user;
    protected $file;
    protected $thumbnail;
    protected $baseDir = "app/public/user/images";
    protected $profile;
    
    public function __construct (UploadedFile $file, User $user, Album $album, $profile=null){
        $this->file = $file;
        $this->user = $user;
        $this->album = $album;
        $this->profile = $profile;
    }
    
    public function process(){
        $this->name = $this->generateName();
        $this->makeThumb()
              ->saveToDB();
            return $this;
        }

    public function generateName (){
        $fileNameWithExt = $this->file->getClientOriginalName();
        $extension = $this->file->getClientOriginalExtension();
        $fileNameToStore = str_random(20).time().'.' .$extension;
        //$this->file->storeAs($this->baseDir, $fileNameToStore);
        $this->makeDirectory();
        return $fileNameToStore;
    }
    
    public function makeThumb(){
        $path = $this->baseDir;
        $thumbnail_path = sprintf("%s/thumb-%s", $path, $this->name); 
        Thumbnail::make($this->file,$thumbnail_path);
        $this->file->move($path, $this->name);
        return $this;
    }
    
    public function saveToDB (){
        Image::create([
            'url'=>$this->name,
            'album_id' => $this->album->id,
            'user_id' => $this->user->id,
            'profile_image' => $this->profile,
            ]);
    }
    public function makeDirectory (){
        $this->baseDir = storage_path($this->baseDir."/".$this->user->id);
        File::makeDirectory($this->baseDir, 0777, true, true);
    }

}