<?php

namespace App\Http\Controllers;

use App\Models\AccountUserPermission;
use App\Services\AccountUserPermissionRequest;
use App\Services\AccountUserPermissionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

    public function update(Request $request){

        try {
            $relation = AccountUserPermission::find($request->relation_id);
            $relation->permission_id = $request->permission_id;
            $relation->save();
        } catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message'=> 'nie udało się zmienić uprawnień',
                'error'=> $e->getMessage()])
                ->setStatusCode(500);
        }
        return response()->json([
            'status' => 'success',
            'message'=> 'zaktualizowano uprawnienia',
            'error' => 'brak błędów'])->setStatusCode(200);

    }


    public function destroy($id){
        $permission = AccountUserPermission::find($id);
        try {
            $permission->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Usunięto powiązanie!',
            ])->setStatusCode(200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Błąd kasowania powiązania!',
            ])->setStatusCode(500);
        }
    }
}
