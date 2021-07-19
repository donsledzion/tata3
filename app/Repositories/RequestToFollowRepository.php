<?php


namespace App\Repositories;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use App\Models\RequestToFollow;
use Illuminate\Http\Request;

class RequestToFollowRepository
{
    protected RequestToFollow $requestToFollow;

    public function __construct(RequestToFollow $requestToFollow){
        $this->requestToFollow = $requestToFollow;
    }

    public function find($id){
        return $this->requestToFollow->find($id);
    }

    public function all() {

        return $this->requestToFollow->all();
    }

    public function store(Request $request)
    {
        $attributes = $request->validated();

        try{

            $new_request_to_follow = RequestToFollow::create($attributes);

            $new_request_to_follow->save();


        } catch(\Exception $e) {
            error_log("Błąd wysyłania prośby o dołączenie...!");
            error_log("error message: ".$e->getMessage());
        }

        return $new_request_to_follow;

    }

    public function update(Request $request, RequestToFollow $requestToFollow)
    {
        return $this->requestToFollow->update();
    }

    public function delete($id)
    {
        $requestToFollow = $this->find($id);
        try {
            $requestToFollow->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Usunięto prośbę o dodanie!',
            ])->setStatusCode(200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Błąd usuwania prośby!',
            ])->setStatusCode(500);
        }
    }

    public function edit(Invitation $invitation)
    {

    }

}
