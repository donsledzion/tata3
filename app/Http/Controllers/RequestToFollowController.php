<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\RequestToFollow;
use App\Models\User;
use App\Services\RequestToFollowService;
use Illuminate\Http\Request;

class RequestToFollowController extends Controller
{
    protected RequestToFollowService $requestToFollowService;

    public function __construct(RequestToFollowService $requestToFollowService){
        $this->requestToFollowService = $requestToFollowService;
    }

    public function store(Request $request)
    {
        try{
        $attributes = $request->all();

        $account = Account::find($request->account_id);
        $requesting = User::find($request->requesting_id);

        if($account->id == $requesting->isParentToAccount()){
            return response()->json([
                'status' => 'fail',
                'message' => 'To przecież Twoje konto!',
            ])->setStatusCode(422);
        }

        if($account->users->contains($requesting)){
            return response()->json([
                'status' => 'fail',
                'message' => 'Już obserwujesz to konto!',
            ])->setStatusCode(422);
        }

        $request_exists_chceck = RequestToFollow::where('account_id','=',$account->id)
                                                    ->where('requesting_id','=',$requesting->id)
                                                    ->first();

        if($request_exists_chceck){
            return response()->json([
                'status' => 'fail',
                'message' => 'Ta prośba już istnieje!',
            ])->setStatusCode(422);
        }


        RequestToFollow::create($attributes);
            return response()->json([
                'status' => 'success',
                'message' => 'Wysłano zaproszenie!',
            ])->setStatusCode(200);
        } catch(\Exception $e){
            error_log("RequestToFollowController - failed attempt to store request in database!");
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd wysyłania prośby o dołączenie!'.$e->getMessage(),
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function accept($id)
    {
        return $this->requestToFollowService->accept($id);
    }


    public function destroy($id)
    {
        return $this->requestToFollowService->delete($id);
    }
}
