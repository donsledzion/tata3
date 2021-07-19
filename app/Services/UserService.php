<?php


namespace App\Services;


use App\Models\User;
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

    public function findByEmail($email){
        $user = $this->user->findByEmail($email);
        if($user){
            $response = [
                'message' => 'znaleziono użytkownika!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ] ;
            error_log("Znaleziono użytkownika o adresie e-mail: ".$email);
            error_log("Użytkownik: ".$user);
            error_log("response: ".$response['message']);
            return response()->json($response)->setStatusCode(200);
        } else {
            $response = ['message' => 'user not found!' ] ;
            error_log("nie znaleziono użytkownika o adresie e-mail: ".$email);
            return response()->json($response)->setStatusCode(500);
        }

    }

    public function indexRelated()
    {
        return $this->user->indexRelated();
    }

}
