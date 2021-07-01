<?php


namespace App\Services;


use App\Repositories\UserRepository;

class UserService
{

    public function __construct(UserRepository $user){
        $this->user = $user;
    }

    public function index(){
        return $this->user->all();
    }
}
