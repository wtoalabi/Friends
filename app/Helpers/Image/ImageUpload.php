<?php
namespace App\Helpers\Image;


use App\Models\Users\User;
use App\Models\Images\Image;
use App\Models\Images\Album;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUpload{
    protected $user;
    protected $image;
    protected $album;
    protected $thumbnail_path;
    protected $plainFileName;
    protected $thumbUrlOnDB;
    protected $fullUrlOnDB;
    protected $baseDir = "app/public/user/images";


    
    public function __construct (UploadedFile $image, User $user, $folderID, $album, $profile){
        $this->image = $image;
        $this->folderID = $folderID;
        $this->user = $user;
        $this->album = $album;
        $this->profile = $profile;
    }
    
    public function process(){
        $this->generateName()
             ->generatePaths()
            ->makeDirectory()
            ->makeThumbnail();
           return $this->saveToDB();
        }

    public function generateName (){
        $fileNameWithExt = $this->image->getClientOriginalName();
        $extension = $this->image->getClientOriginalExtension();
        $this->plainFileName = str_random(20).time().'.' .$extension;
        return $this;
    }
    
    public function makeDirectory (){
        File::makeDirectory($this->baseDir, 0777, true, true);
        return $this;

    }

    public function makeThumbnail(){
        Thumbnail::make($this->image,$this->thumbnail_path);
        $this->image->move($this->baseDir, $this->plainFileName);
        return $this;
    }
    
    public function saveToDB (){
        return Image::create([
            'album_id' => $this->album,
            'user_id' => $this->user->id,
            'full' => $this->fullUrlOnDB,
            'thumb' => $this->thumbUrlOnDB,
            'profile' => $this->profile,
            'folderID' => $this->folderID,
            ]);
    }
    

    public function generatePaths (){
        $userImagePath = $this->user->id."/". $this->folderID;
        $this->baseDir = storage_path($this->baseDir.'/'.$userImagePath);
        $this->thumbnail_path = sprintf("%s/thumb-%s", $this->baseDir, $this->plainFileName); 
        $this->fullUrlOnDB = sprintf("images/%s/%s", $userImagePath,$this->plainFileName);
        $this->thumbUrlOnDB = sprintf("images/%s/thumb-%s", $userImagePath,$this->plainFileName);
        return $this;
    } 

    public static function remove ($id){
        $image = Image::find($id);
        $image->delete();
        Storage::delete(["public/user/$image->full","public/user/$image->thumb"]);
         return;

    }

}
