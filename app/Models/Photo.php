<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function store(Request $request){
        $validatedData = $request->validate([
            'avatar' => 'image|mimes:jpg,png,jpeg,gif',
            'picture' => 'image|mimes:jpg,png,jpeg,gif',

        ]);
        error_log("PHOTO MODEL | after validation" );
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
            error_log("PHOTO MODEL | file_name: ". $file_name);
            error_log("===============================================");
            if(!empty($request->file('avatar'))) {
                $name = Str::ascii(Str::snake($file_name.'.'.$request->file('avatar')->extension(),'_'),'pl');
                $path = $request->file('avatar')->storeAs('tmp', $name);
            } else if(!empty($request->file('picture'))) {
                $name = Str::ascii(Str::snake($file_name.'.'.$request->file('picture')->extension(),'_'),'pl');
                $path = $request->file('picture')->storeAs('tmp', $name);
            } else {
                $gender = Gender::find($request->gender);
                $name = Str::ascii(Str::snake($file_name.'.png','_'),'pl');
                error_log("Default picture -> name: ".$name);
                Storage::copy('defaults/default_'.__($gender->name).'.png', 'tmp/' . $name);
                $path = 'tmp/'.$name;
                error_log("Default picture -> path: ".$path);
            }

            $this->name = $name;
            $this->path = $path;
            $this->save();

        }  catch(\Exception $e){

            error_log("jestem w Photo (Model) - coś się wyjebało przy zapisie pliku");
            error_log("error message: ". $e->getMessage());
            return $e;
        }
        return $this;
    }

    public function upload(Request $request, $account_id){


        if(!empty($request->file('avatar'))||(!empty($request->file('picture')))||(!empty($request->gender))) {


            try{
                if(!empty($request->file('avatar'))) {
                    $target_name = date("Ymd").date("His").".".$request->file('avatar')->extension();
                } if(!empty($request->file('picture'))) {
                    $target_name = date("Ymd").date("His").".".$request->file('picture')->extension();
                } else {
                    $target_name = date("Ymd").date("His").'.png';
                }

                error_log("target name:".$target_name);

                $this->store($request);

                error_log("target name2:".$target_name);



                Photo::find($this->id)->organize($target_name, $account_id);

                return $target_name;

            } catch(\Exception $e){
                error_log("Błąd wysyłania plików na serwer:");
                error_log("Error message: " . $e->getMessage());
            }
        } else {
            error_log("Nie ma fotki!");
        }
    }

    public function organize($target_name, $account_id)
    {
        try {
            self::moveAndResize($this->path, $target_name, $account_id, 768);                   // copies and resizes pictures
            self::moveAndResize($this->path, $target_name, $account_id, 480);                   // in fixed resolutions
            self::moveAndResize($this->path, $target_name, $account_id, 320);                   // and directories
            self::moveAndResize($this->path, $target_name, $account_id, 160, true);     // the last is moved from /tmp directory
            $this->delete(); // clears database entry after succesfull picture moving
        } catch(\Exception $e){
            error_log("error message: ". $e->getMessage());
        }
        return true;
    }

    private static function moveAndResize($picture_path, $target_name, $account_id, $size,bool $moveFlag=false){

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

    public function unlinkPicture($account_id,$picture){
        Storage::delete($account_id.'/160/'.$picture);
        Storage::delete($account_id.'/320/'.$picture);
        Storage::delete($account_id.'/480/'.$picture);
        Storage::delete($account_id.'/768/'.$picture);
    }

}
