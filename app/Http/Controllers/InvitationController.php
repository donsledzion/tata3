<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class InvitationController extends Controller
{

    protected InvitationService $invitationService;

    public function __construct(InvitationService $invitationService){
        $this->invitationService = $invitationService;
    }

    public function index(){
        return $this->invitationService->index();
    }


    public function store(InvitationRequest $request)
    {
        return $this->invitationService->store($request);
        //return redirect()->route('friends.index');
    }

    public function accept(Invitation $invitation)
    {
        return $this->invitationService->accept($invitation);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
     public function destroy($id)
     {
         return $this->invitationService->delete($id);
     }


}
