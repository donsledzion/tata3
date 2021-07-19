<?php


namespace App\Repositories;


use App\Models\AccountUserPermission;

class AccountUserPermissionRepository
{

    protected AccountUserPermission $accountuserpermission;

    public function __construct(AccountUserPermission $accountuserpermission){
        $this->accountuserpermission = $accountuserpermission;
    }

    public function findByAccount($id){

    }

    public function findByUser($id){

    }

    public function findByPermission($id){

    }

    public function all(){
        return $this->accountuserpermission->paginate(10);
    }

    public function store($attributes){
        $accountuserpermission = new AccountUserPermission($attributes);

        return $accountuserpermission->save();

    }


}
