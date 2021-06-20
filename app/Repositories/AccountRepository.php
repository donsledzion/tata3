<?php


namespace App\Repositories;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountRepository
{

    protected  Account $account;

    public function __construct(Account $account) {
        $this->account = $account ;
    }

    public function find($id) {

        return $this->account->find($id);
    }

    public function all() {
        return $this->account->paginate(5);
    }

    public function store($attributes){

        $creation = new Account($attributes);
        $creation->save() ;
        error_log("=====================================================");
        error_log("creation_id: ". $creation->id);
        error_log("current_id: ". Auth::id());
        error_log("creation: ".$creation);
        error_log("=====================================================");
        return $creation;
    }

    public function update($id, array $attributes){
        return $this->account->find($id)->update($attributes);
    }

    public function delete($id) {
        return $this->account->find($id)->delete();
    }

}
