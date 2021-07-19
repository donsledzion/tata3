<?php


namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Models\AccountUserPermission;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationRepository
{
    protected Invitation $invitation;

    public function __construct(Invitation $invitation){
        $this->invitation = $invitation;
    }

    public function find($id){
        return $this->invitation->find($id);
    }

    public function all() {

        return $this->invitation->all();
    }

    public function store(InvitationRequest $request)
    {
        $attributes = $request->validated();


        $already_invited_check = Invitation::where('account_id','=',$request->account_id)
                                        ->where('invited_id','=',$request->invited_id)
                                        ->first();
        if($already_invited_check){
            return response()->json([
                'status' => 'fail',
                'message' => 'Użytkownik jest już zaposzony!',
            ])->setStatusCode(500);
        }

        $already_follows_check = AccountUserPermission::where('account_id','=',$request->account_id)
                                                        ->where('user_id','=',$request->invited_id)
                                                        ->first();

        if($already_follows_check){
            return response()->json([
                'status' => 'fail',
                'message' => 'Użytkownik już obserwuje Twoje konto!',
            ])->setStatusCode(500);
        }

        try{

            $new_invitation = Invitation::create($attributes);

            $new_invitation->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Wysłano zaproszenie!',
            ])->setStatusCode(200);

        } catch(\Exception $e) {
            error_log("Błąd dodawania zaproszenia!");
            error_log("error message: ".$e->getMessage());
        }



    }

    public function update(InvitationRequest $request, Invitation $invitation)
    {
        return $this->invitation->update();
    }

    public function delete($id)
    {
        $invitation = $this->find($id);
        try {
            $invitation->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Usunięto zaproszenie!',
            ])->setStatusCode(200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Błąd kasowania!',
            ])->setStatusCode(500);
        }
    }

    public function edit(Invitation $invitation)
    {

    }

}
