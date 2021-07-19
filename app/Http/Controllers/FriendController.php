<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountUserPermission;
use App\Models\Invitation;
use App\Models\Permission;
use App\Models\User;
use App\Services\FriendService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public FriendService $friendService;

    public function __construct(FriendService $friendService){
        $this->friendService = $friendService;
    }



    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $user = User::find(Auth::id()) ;
        $account = Account::find($user->isParentToAccount());
        $permissions = Permission::all();


        return view('friends.index',[
            'user' => $user,
            'account' => $account,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function store($id):JsonResponse
    {

        $invitation = Invitation::find($id);

        $permissionRequest = [
            'account_id'=>$invitation->account->id,
            'user_id'=>$invitation->invited->id,
            'permission_id'=>$invitation->permission->id,
        ];
        $storeInvitationResponse = app('App\Http\Controllers\AccountUserPermissionController')
            ->store($permissionRequest);

        $deleteInvitationResponse = app('App\Http\Controllers\InvitationController')
            ->destroy($id);

        $storeResponse = json_decode($storeInvitationResponse->getContent(), true);
        $deleteResponse = json_decode($deleteInvitationResponse->getContent(), true);

        return response()->json([
        'status' => 'success',
        'message' => 'Pomyślnie zaakceptowano zaproszenie!',
    ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->friendService->delete($id);
    }
}
