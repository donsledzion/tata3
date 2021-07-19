<?php


namespace App\Services;


use App\Http\Requests\StoreKidRequest;
use App\Models\Kid;
use App\Models\User;
use App\Repositories\KidRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KidService
{
    public function __construct(KidRepository $kid){
        $this->kid = $kid;
    }

    public function index() {
        if(Auth::user()->isAdmin()) {
            return $this->kid->all();
        } else {
            return $this->kid->related(User::find(Auth::id()));
        }
    }

    public function show($id){
        return $this->kid->find($id);
    }

    public function store(StoreKidRequest $request){

        return $this->kid->store($request);

    }

    public function update(StoreKidRequest $request, Kid $kid)
    {
        $user = User::find(Auth::id());
        if($user->isParentToAccount()==$kid->account_id) {
            return $this->kid->update($request, $kid);
        }
        $response = [
            'status' => 'fail',
            'message' => 'Błąd edycji - brak uprawnień',
        ];
        return View('denied',$response);
    }

    public function edit(Kid $kid)
    {
        $user = User::find(Auth::id());
        if($user->isParentToAccount()==$kid->account_id) {
            return $this->kid->edit($kid);
        }
        $response = [
            'status' => 'fail',
            'message' => 'Błąd edycji - brak uprawnień',
        ];
        return View('denied',$response);
    }

    public function delete(Kid $kid)
    {
        $user = User::find(Auth::id());
        if($user->isParentToAccount()==$kid->account_id) {
            return $this->kid->delete($kid);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'Błąd kasowania - brak uprawnień!',
        ])->setStatusCode(403);
    }
}
