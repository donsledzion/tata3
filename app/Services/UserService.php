<?php


namespace App\Services;


use App\Repositories\UserRepository;

class UserService
{

    public function __construct(UserRepository $user){
        $this->user = $user;
    }

    public function index(){
        $results =  $this->user->all();
        if(!empty($results)) {
            return view('users.related', [
                'users' => $results
            ]);
        }
        return redirect(route('welcome'));
    }
}
