<?php


namespace App\Services;

use App\Http\Requests\AccountRequest;
use App\Repositories\AccountRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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

        return $newAccount;
    }

    public function show($id){
        return $this->account->find($id);
    }

    public function update(Request $request, $id){
        $attributes = $request->all();

        return $this->account->update($id, $attributes);
    }

    public function delete($id){
        return $this->account->delete($id);
    }
}
