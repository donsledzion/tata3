<?php


namespace App\Services;


use App\Repositories\AccountRepository;
use App\Repositories\AccountUserPermissionRepository;

class AccountUserPermissionService
{
    public function __construct(AccountUserPermissionRepository $accountuserpermission){
        $this->accountuserpermission = $accountuserpermission ;
    }

    public function index(){
        return $this->accountuserpermission->all();
    }

    public function store(array $request){
        $attributes = $request;

        return $this->accountuserpermission->store($attributes);
    }
}
