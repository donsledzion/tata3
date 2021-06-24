<?php


namespace App\Services;


use App\Repositories\KidRepository;
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
            return $this->kid->related();
        }
    }
}
