<?php

namespace App\Http\Controllers;

use App\Services\AccountUserPermissionRequest;
use App\Services\AccountUserPermissionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AccountUserPermissionController extends Controller
{

    protected AccountUserPermissionService $accountuserpermissionservice;

    public function __construct(AccountUserPermissionService $accountuserpermissionservice){
        $this->accountuserpermissionservice = $accountuserpermissionservice;
    }

    public function index(): Application|Factory|View
    {
        $permissiontable = $this->accountuserpermissionservice->index();
        return view('accountsuserspermissions.index', compact($permissiontable));
    }

    public function store(array $request){

        try {
            $this->accountuserpermissionservice->store($request);
        } catch(\Exception $e){

            return response()->json([
                'status' => 'fail',
                'message'=> 'nie udało się nadać uprawnień',
                'error'=> $e->getMessage()])
                ->setStatusCode(500);
        }
        return response()->json([
            'status' => 'success',
            'message'=> 'dodano uprawnienia',
            'error' => 'brak błędów'])->setStatusCode(201);
    }
}
