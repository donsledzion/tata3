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
        return $this->kid->update($request, $kid);
    }

    public function edit(Kid $kid)
    {
        return $this->kid->edit($kid);
    }

    public function delete(Kid $kid)
    {
        return $this->kid->delete($kid);
    }
}
