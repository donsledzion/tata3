<?php


namespace App\Repositories;
use App\Http\Controllers\UploadImageController;
use App\Models\Kid;
use App\Models\Photo;
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

    public function related(){
        $kids = Kid::join('accounts','accounts.id','=','kids.account_id')
            ->join('genders','genders.id','=','kids.gender')
            ->join('account_user_permission','account_user_permission.account_id','=','accounts.id')
            ->join('users','users.id','=','account_user_permission.user_id')
            ->join('permissions','permissions.id','=','account_user_permission.permission_id')

            ->where('users.id','=',Auth::id())
            ->where('permissions.allow_read','=','1')
            ->select('kids.*',
                'genders.name as kid_gender',
                'accounts.id as kid_account_id',
                'accounts.name as kid_account',
                'accounts.avatar as account_avatar')
            ->orderby('permissions.id','asc')
            ->orderby('kids.birth_date', 'asc')
            ->paginate(15);
        return $kids;
    }

    public function store($request){

        $attributes = $request->all();
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
