<?php


namespace App\Repositories;

use App\Models\Account;
use App\Models\Photo;
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

        $new_account = Account::create($attributes);
        try {

            $uploaded_picture = new Photo();

            $new_account->avatar = $uploaded_picture->upload($request,$new_account->id);

            $new_account->save();
        } catch(\Exception $e){
            error_log("Błąd zapisu konta:");
            error_log("Error message: " . $e->getMessage());
        }

        return $new_account;
    }

    public function update($request, $account){

        $old_avatar = $account->avatar;

        $edited_account = $account->fill($request->all());

        error_log("==================================================================");
        if($request->avatar){
            error_log("Need to update picutre!!! Picture name:".$request->avatar );
            $uploaded_picture = new Photo();

            $edited_account->avatar = $uploaded_picture->upload($request, $account->id);

            $picture_to_delete = new Photo();
            $picture_to_delete->unlinkPicture($account->id,$old_avatar);

        } else {
            error_log("No picture to update");
        }
        error_log("==================================================================");

        return $edited_account->save();
    }

    public function delete($id) {

        try {
            $account_to_delete = $this->account->find($id);
            error_log("Got here                                      1");
            $picture_to_delete = new Photo();
            error_log("Got here                                      2");
            $picture_to_delete->unlinkPicture($account_to_delete->id,$account_to_delete->avatar);
            error_log("Got here                                      3");
            $account_to_delete->delete();
            error_log("Got here                                      4");
            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd!',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
