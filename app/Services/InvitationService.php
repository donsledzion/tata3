<?php


namespace App\Services;


use App\Http\Requests\InvitationRequest;
use App\Models\Account;
use App\Models\Invitation;
use App\Models\Post;
use App\Models\User;
use App\Repositories\InvitationRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationService
{

    public function __construct(InvitationRepository $invitation){
        $this->invitation = $invitation;
    }

    public function index() {
        $user = User::find(Auth::id());
        if($user->isAdmin()) {
            return $this->invitation->all();
        } else {
            return $this->invitation->all();
        }
    }



    public function store(InvitationRequest $request)
    {
        return $this->invitation->store($request);
    }

    public function delete($id)
    {
        return $this->invitation->delete($id);
    }

    public function edit(Invitation $invitation)
    {
        return $this->invitation->edit($invitation);
    }

    public function update(InvitationRequest $request, Invitation $invitation)
    {
        return $this->invitation->update($request, $invitation);
    }

    public function accept(Invitation $invitation)
    {
        //$invitation = Invitation::find($id);

        $permissionRequest = [
            'account_id'=>$invitation->account->id,
            'user_id'=>$invitation->invited->id,
            'permission_id'=>$invitation->permission->id,
        ];
        $storeInvitationResponse = app('App\Http\Controllers\AccountUserPermissionController')
            ->store($permissionRequest);

        $deleteInvitationResponse = app('App\Http\Controllers\InvitationController')
            ->destroy($invitation->id);

        $storeResponse = json_decode($storeInvitationResponse->getContent(), true);
        $deleteResponse = json_decode($deleteInvitationResponse->getContent(), true);

        return response()->json([
            'status' => 'success',
            'message' => 'Pomyślnie zaakceptowano zaproszenie!',
        ])->setStatusCode(200);

    }

}
