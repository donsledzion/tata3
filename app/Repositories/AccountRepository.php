<?php


namespace App\Repositories;

use App\Http\Controllers\UploadImageController;
use App\Models\Account;
use App\Models\Photo;
use App\Services\UploadImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AccountRepository
{

    protected  Account $account;

    public function __construct(Account $account) {
        $this->account = $account ;
    }

    public function find($id) {

        return $this->account->find($id);
    }

    public function all() {
        return $this->account->paginate(5);
    }

    public function store($request){

        $attributes = $request->validated();
        try {
            $creation = Account::create($attributes);
            if (!empty($request->file('avatar'))) {
                try {
                    $uploadedImage = (new UploadImageController(new UploadImageService(new Photo())))->save($request);
                    $creation->avatar = $uploadedImage->name;
                } catch (\Exception $e) {
                    error_log("Błąd wysyłania plików na serwer:");
                    error_log("Error message: " . $e->getMessage());
                }
            } else {
                error_log("Nie ma fotki!");
            }

            $creation->save();
        } catch(\Exception $e){
            error_log("Błąd zapisu konta:");
            error_log("Error message: " . $e->getMessage());
        }

        (new UploadImageController(new UploadImageService(new Photo())))->organizePictures($uploadedImage->id,$creation->avatar, $creation->id);

        return $creation;
    }

    public function update($id, array $attributes){
        return $this->account->find($id)->update($attributes);
    }

    public function delete($id) {
        return $this->account->find($id)->delete();
    }
}
