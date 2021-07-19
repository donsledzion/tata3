<?php


namespace App\Repositories;


use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected User $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function find($id){
        return $this->user->find($id);
    }

    public function findByEmail($email){
        return $this->user->where('email','=',$email)->first();
    }

    public function all(){
        if(Auth::user()->isAdmin()) {
            return User::join('user_status', 'user_status.id', '=', 'users.status_id')
                ->select(['users.id', 'users.email', 'users.name', 'users.email_verified_at',
                    'user_status.name as status'])
                ->get();
        } else {
            // here should be query that returns all users that are in relation with logged user
            $account_of_user = Account::find(Auth::user()->isParentToAccount());
            if($account_of_user){
                return $account_of_user->users;
            } else {
                return null;
            }
        }
    }

    public function indexRelated()
    {
        $account = Account::find(User::find(Auth::id())->isParentToAccount());
        if($account) {
            return $account->users;
        }
        return null;

    }

}
