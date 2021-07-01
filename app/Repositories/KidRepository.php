<?php


namespace App\Repositories;
use App\Http\Controllers\UploadImageController;
use App\Models\Account;
use App\Models\Kid;
use App\Models\Photo;
use App\Models\User;
use App\Services\UploadImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KidRepository
{

    protected Kid $kid;

    public function __construct(Kid $kid){
        $this->kid = $kid;
    }

    public function find($id){
        return $this->kid->find($id);
    }

    public function all(){
        return $this->kid->paginate(15);
    }

    public function related(User $user){

        return $user->kids();
    }

    public function store($request){

        $attributes = $request->validated();
        $attributes['account_id'] = Auth::user()->isParentToAccount();
        try {
            $newKid = Kid::create($attributes);
            if(!empty($request->file('avatar'))){
                try{
                    $uploadedImage = (new UploadImageController(new UploadImageService(new Photo())))->save($request);
                    $newKid->avatar = $uploadedImage->name;
                } catch(\Exception $e){
                    error_log("Błąd wysyłania plików na serwer:");
                    error_log("Error message: " . $e->getMessage());
                }
            } else {
                error_log("Nie ma fotki!");
            }

            $newKid->save();
        } catch(\Exception $e){
            error_log("Błąd zapisu konta:");
            error_log("Error message: " . $e->getMessage());
        }

        (new UploadImageController(new UploadImageService(new Photo())))->organizePictures($uploadedImage->id, $newKid->avatar, Auth::user()->isParentToAccount());

        return $newKid;
    }

    public function update($id, array $attributes){
        return $this->kid->find($id)->update($attributes);
    }

    public function delete($id){
        return $this->kid->find($id)->delete();
    }
}
