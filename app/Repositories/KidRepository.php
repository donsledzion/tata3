<?php


namespace App\Repositories;
use App\Http\Requests\KidRequest;
use App\Http\Requests\StoreKidRequest;
use App\Models\Kid;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(StoreKidRequest $request){

        $attributes = $request->validated();

        if(empty($attributes['dim_name'])){
            $attributes['dim_name'] = $attributes['first_name'] ;
        }

        $attributes['account_id'] = Auth::user()->isParentToAccount();

        $new_kid = Kid::create($attributes);
        try {
            $uploaded_picture = new Photo();

            $new_kid->avatar = $uploaded_picture->upload($request,User::find(Auth::id())->isParentToAccount());

            $new_kid->save();

        } catch(\Exception $e){
            error_log("Błąd zapisu konta:");
            error_log("Error message: " . $e->getMessage());
        }

        return $new_kid;
    }

    public function update(StoreKidRequest $request, Kid $kid){

        $old_avatar = $kid->avatar;

        $attributes = $request->validated();

        if(empty($attributes['dim_name'])){
            error_log("dim_name: ".$attributes['dim_name']);
            error_log("first_name: ".$attributes['first_name']);

            $attributes['dim_name'] = $attributes['first_name'] ;
        }

        $edited_kid = $kid->fill($attributes);

        error_log("==================================================================");
        if($request->avatar){
            error_log("Need to update picutre!!! Picture name:".$request->avatar );
            $uploaded_picture = new Photo();

            $edited_kid->avatar = $uploaded_picture->upload($request, $kid->account_id);

            $picture_to_delete = new Photo();
            $picture_to_delete->unlinkPicture($kid->account_id,$old_avatar);

        } else {
            error_log("No picture to update");
        }

        error_log("==================================================================");

        return $edited_kid->save();

    }

    public function edit(Kid $kid)
    {
        return view('kids.edit',[
            'kid'=> $kid
        ]);
    }

    public function delete(Kid $kid){
        try {
            error_log("KidRepository | delete(kid:".$kid->dim_name." ) ; step 1");
            foreach($kid->posts as $post){
                $post->deleteWithPicture();
            }
            $picture_to_delete = new Photo();

            $picture_to_delete->unlinkPicture($kid->account->id,$kid->avatar);
            $kid->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Usunięto profil Bombelka!',
            ])->setStatusCode(200);;
        } catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd!',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
