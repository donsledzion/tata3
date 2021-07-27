<?php


namespace App\Services;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\AccountUserPermission;
use App\Models\Invitation;
use App\Models\Photo;
use App\Models\User;
use App\Repositories\AccountRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File;

class AccountService
{

    public function __construct(AccountRepository $account){
        $this->account = $account ;
    }

    public function index(){
        return $this->account->all();
    }

    public function store(AccountRequest $request){
        if(! Gate::forUser(Auth::user())->allows('create-account', $this->account)){
            abort(403);
        }
        DB::beginTransaction();
        try{
            $newAccount = $this->account->store($request);

            $permissionRequest = [
                'account_id'=>$newAccount->id,
                'user_id'=>Auth::id(),
                'permission_id'=>'1' // User's permission to created account is set PARENT by default
            ];
            $jsonResponse = app('App\Http\Controllers\AccountUserPermissionController')
                ->store($permissionRequest);
            $response = json_decode($jsonResponse->getContent(), true);
            if($response['status']=='fail'){
                error_log("===============================================");
                error_log("OJ! COMMITA NIE BĘDZIE!");
                error_log("===============================================");
                throw  new Exception();

            }
        DB::commit();
            error_log("===============================================");
            error_log("ZAPISUJĘ DO BAZY - commit()");
            error_log("===============================================");
        }catch(\Exception $e){
            error_log("===============================================");
            error_log("BĘDZIE ROLLBACK!");
            error_log("error: ".$e->getMessage());
            error_log("===============================================");
            DB::rollBack();
            return $e->getMessage();
        }
        //return $newAccount;
        return redirect(route('accounts.show',[$newAccount]));
    }

    public function show($id){

        $account = $this->account->find($id);
        if(!empty($account)){
            return view("accounts.show", [
                'account' => $account
            ] );
        } else {
            return view("posts.index" );
        }
    }

    public function edit($id){
        $user = User::find(Auth::id());
        $account = $this->account->find($id);
        if(!empty($account)&&($user->isParentToAccount()==$account->id)){
            return view("accounts.edit", [
                'account' => $account
            ] );
        } else {
            return view("posts.index" );
        }
    }

    public function update(Request $request, Account $account){
        $user = User::find(Auth::id());
        if($user->isParentToAccount()==$account->id) {
            return $this->account->update($request, $account);
        }
        return response()->json([
                'status' => 'fail',
                'message' => 'Błąd edycji - brak uprawnień!'])
            ->setStatusCode(403);
    }

    public function delete($id){
        try {
            $user = User::find(Auth::id());
            $account = $this->account->find($id);
            if(($account->id)!=$user->isParentToAccount()){
                Throw new Exception();
            }
            foreach ($account->kids as $kid) {
                $kid->deleteWithPicture();
            }

            $picture_to_delete = new Photo();

            $picture_to_delete->unlinkPicture($account->id,$account->avatar);


            $relations = AccountUserPermission::where('account_id','=',$account->id)->get();

            foreach ($relations as $relation){

                    $relation->delete();
            }

            $invitations = Invitation::where('account_id','=',$account->id)->get();

            foreach ($invitations as $invitation){

                $invitation->delete();
            }

            $account_id = $account->id;

            $account->delete($id);

            Storage::deleteDirectory($account_id);

            return response()->json([
                'status' => 'success',
                'message' => 'Pomyślnie usunięto konto Rodzinki!',
            ])->setStatusCode(200);

        } catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd kasowania Rodzinki!'.$e->getMessage(),
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
