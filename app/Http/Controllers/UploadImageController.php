<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use PharIo\Manifest\ElementCollectionException;


class UploadImageController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function save(Request $request)
    {
        error_log("jestem w kontrolerze UploadImageController - start");
        $validatedData = $request->validate([
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif',

        ]);
        try {
            $name = Str::ascii(Str::snake($request['name'].'.'.$request->file('avatar')->extension(),'_'),'pl');

            $path = $request->file('avatar')->storeAs('tmp', $name);

            $save = new Photo;

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

    public function organizePictures($picture_id, $account_id)
    {
        try {
            $picture = Photo::find($picture_id); // finds Photo in database using it's id

            self::moveAndResize($picture->path, $account_id, 768); // copies and resizes pictures
            self::moveAndResize($picture->path, $account_id, 480); // in fixed resolutions
            self::moveAndResize($picture->path, $account_id, 320); // and directories
            self::moveAndResize($picture->path, $account_id, 160, true); // the last is moved from /tmp directory
            $picture->delete(); // clears database entry after succesfull picture moving
        } catch(\Exception $e){
            error_log("error message: ". $e->getMessage());
        }

        return true;
    }

    private static function moveAndResize($picture_path, $account_id, $size,bool $moveFlag=false){
        $picture_name = basename($picture_path);
        $target_dir = $account_id.'/'.$size ;
        Storage::makeDirectory($target_dir);
        if($moveFlag == true){ //when $moveFlag is set to TRUE picture is moved instead of just beeing coppied
            Storage::move($picture_path,$target_dir.'/'.$picture_name);
        } else {
            Storage::copy($picture_path, $target_dir . '/' . $picture_name);
        }
        $fullpath = storage_path('app/pictures/'.$target_dir.'/'.$picture_name);
        Image::make($fullpath)->orientate()->resize($size,$size,function($constraint){
            $constraint->aspectRatio();
        })->save();
    }
}
