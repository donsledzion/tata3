<?php


namespace App\Services;


use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadImageService
{

    public function __construct(Photo $uploadImage)
    {
        $this->uploadImage = $uploadImage;
    }

    public function index()
    {
        return $this->uploadImage->all();
    }

    public function create(Request $request){

        $attributes = $request->all();

        return $this->uploadImage->create($attributes);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif',

        ]);
        try {
            if(!empty($request['name'])){
                $file_name = $request['name'] ;
            } else if(!empty($request['dim_name'])){
                $file_name = $request['dim_name'] ;
            } else if(!empty($request['first_name'])){
                $file_name = $request['first_name'] ;
            }else {
                $file_name = 'avatar' ;
            }
            error_log("===============================================");
            error_log("file_name: ". $file_name);
            error_log("===============================================");

            $name = Str::ascii(Str::snake($file_name.'.'.$request->file('avatar')->extension(),'_'),'pl');
            $path = $request->file('avatar')->storeAs('tmp', $name);

            $save = $this->uploadImage;
            $save->name = $name;
            $save->path = $path;
            $save->save();

        }  catch(\Exception $e){

            error_log("jestem w kontrolerze UploadImageController - coś się wyjebało przy zapisie pliku");
            error_log("error message: ". $e->getMessage());
            return $e;
        }
        return $save;
    }


    public function organizePictures($picture_id, $target_name, $account_id)
    {
        try {
            $picture = Photo::find($picture_id); // finds Photo in database using it's id
            self::moveAndResize($picture->path, $target_name, $account_id, 768); // copies and resizes pictures
            self::moveAndResize($picture->path, $target_name, $account_id, 480); // in fixed resolutions
            self::moveAndResize($picture->path, $target_name, $account_id, 320); // and directories
            self::moveAndResize($picture->path, $target_name, $account_id, 160, true); // the last is moved from /tmp directory
            $picture->delete(); // clears database entry after succesfull picture moving
        } catch(\Exception $e){
            error_log("error message: ". $e->getMessage());
        }
        return true;
    }

    private static function moveAndResize($picture_path, $target_name, $account_id, $size,bool $moveFlag=false){
        $picture_name = basename($picture_path);
        $target_dir = $account_id.'/'.$size ;
        Storage::makeDirectory($target_dir);
        if($moveFlag == true){ //when $moveFlag is set to TRUE picture is moved instead of just beeing coppied
            Storage::move($picture_path,$target_dir.'/'.$target_name);
        } else {
            Storage::copy($picture_path, $target_dir . '/' . $target_name);
        }
        $fullpath = storage_path('app/pictures/'.$target_dir.'/'.$target_name);
        Image::make($fullpath)->orientate()->resize($size,$size,function($constraint){
            $constraint->aspectRatio();
        })->save();
    }
}
