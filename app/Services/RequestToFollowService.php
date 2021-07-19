<?php


namespace App\Services;


use App\Http\Requests\InvitationRequest;
use App\Models\Account;
use App\Models\Invitation;
use App\Models\Post;
use App\Models\RequestToFollow;
use App\Models\User;
use App\Repositories\InvitationRepository;
use App\Repositories\PostRepository;
use App\Repositories\RequestToFollowRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestToFollowService
{

    public function __construct(RequestToFollowRepository $requestToFollowRepository){
        $this->requestToFollow = $requestToFollowRepository;
    }

    public function index() {
        $user = User::find(Auth::id());
        if($user->isAdmin()) {
            return $this->requestToFollow->all();
        } else {
            return $this->requestToFollow->all();
        }
    }



    public function store(Request $request)
    {
        return $this->requestToFollow->store($request);
    }

    public function delete($id)
    {
        return $this->requestToFollow->delete($id);
    }

    public function edit(RequestToFollow $requestToFollow)
    {
        return $this->requestToFollow->edit($requestToFollow);
    }

    public function update(Request $request, RequestToFollow $requestToFollow)
    {
        return $this->requestToFollow->update($request, $requestToFollow);
    }

    public function accept($id)
    {
        $requestToFollow = RequestToFollow::find($id);
        try {
            error_log("RequestToFollowService: try entry");
            error_log("account_id: ".$requestToFollow->account->id );
            $permissionRequest = [
                'account_id' => $requestToFollow->account->id,
                'user_id' => $requestToFollow->user->id,
                'permission_id' => '3', // hard-coded lower permission - friend. Later need to make it possible to edit permission
            ];
            error_log("user_id: ".$requestToFollow->user->id );
            $storeRequestResponse = app('App\Http\Controllers\AccountUserPermissionController')
                ->store($permissionRequest);
            error_log("stored");
            $deleteRequestResponse = app('App\Http\Controllers\RequestToFollowController')
                ->destroy($requestToFollow->id);

            $storeResponse = json_decode($storeRequestResponse->getContent(), true);
            $deleteResponse = json_decode($deleteRequestResponse->getContent(), true);

            return response()->json([
                'status' => 'success',
                'message' => 'Pomyślnie zaakceptowano zaproszenie!',
            ])->setStatusCode(200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Nie udało się zaakceptować zaproszenia!'.$e->getMessage(),
            ])->setStatusCode(500);
        }

    }

}
