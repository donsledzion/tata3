<?php


namespace App\Services;


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

    public function store(Request $request){

        $newKid = $this->kid->store($request);

        return $newKid;
    }
}
