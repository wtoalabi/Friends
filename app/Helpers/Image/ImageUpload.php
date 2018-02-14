<?php
namespace App\Helpers\Image;


use App\Models\Users\User;
use App\Models\Images\Image;
use App\Models\Images\Album;
use Illuminate\Http\UploadedFile;
use App\Models\Images\ProfileImage;
use Illuminate\Support\Facades\File;

class ImageUpload{
    protected $user;
    protected $image;
    protected $imagePath;
    protected $album;
    protected $thumbnail_path;
    protected $fileName;
    protected $thumbUrlOnDB;
    protected $fullUrlOnDB;
    protected $baseDir = "app/public/user/images";


    
    public function __construct (UploadedFile $image, User $user, Album $album, $profile=null){
        $this->image = $image;
        $this->user = $user;
        $this->album = $album;
        $this->profile = $profile;
    }
    
    public function process(){
        $this->generateName()
             ->generatePaths()
            ->makeDirectory()
            ->makeThumbnail();
            $image = $this->saveToDB();
            if($this->profile){
                ProfileImage::add($image);
            }
              return $image;
        }

    public function generateName (){
        $fileNameWithExt = $this->image->getClientOriginalName();
        $extension = $this->image->getClientOriginalExtension();
        $this->fileName = str_random(20).time().'.' .$extension;
        return $this;
    }
    
    public function makeDirectory (){
        File::makeDirectory($this->baseDir, 0777, true, true);
        return $this;

    }

    public function makeThumbnail(){
        Thumbnail::make($this->image,$this->thumbnail_path);
        $this->image->move($this->baseDir, $this->fileName);
        return $this;
    }
    
    public function saveToDB (){
        return Image::create([
            'album_id' => $this->album->id,
            'user_id' => $this->user->id,
            'full' => $this->fullUrlOnDB,
            'thumb' => $this->thumbUrlOnDB,
            'profile' => $this->profile,
            ]);
    }
    

    public function generatePaths (){
        $this->imagePath = $this->user->id."/". $this->album->folderID;
        $this->baseDir = storage_path($this->baseDir.'/'.$this->imagePath);
        $this->thumbnail_path = sprintf("%s/thumb-%s", $this->baseDir, $this->fileName); 
        $this->fullUrlOnDB = sprintf("images/%s/%s", $this->imagePath,$this->fileName);
        $this->thumbUrlOnDB = sprintf("images/%s/thumb-%s", $this->imagePath,$this->fileName);
        return $this;
    } 

}