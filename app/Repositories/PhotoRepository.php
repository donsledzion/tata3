<?php


namespace App\Repositories;
use App\Http\Controllers\UploadImageController;
use App\Models\Kid;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoRepository
{

    protected Photo $photo;

    public function __construct(Photo $photo){
        $this->photo = $photo;
    }


    public function find($id){
        return $this->photo->find($id);
    }

    public function all(){
        return $this->photo->all();
    }

    public function store($request){

    }

    public function update($id, array $attributes){

    }

    public function delete($id){

    }
}
