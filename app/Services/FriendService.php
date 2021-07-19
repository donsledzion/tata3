<?php


namespace App\Services;


use App\Models\AccountUserPermission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class FriendService
{


    public function delete($id)
    {

        $permission = AccountUserPermission::find($id);

        if($permission){
            $user = User::find(Auth::id());
            if(($permission->user->id == $user->id)&($permission->permission_id == '1')){
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Nie możesz odłączyć się od swojego konta!',
                ])->setStatusCode(500);
            }
        }

        try {
            return app('App\Http\Controllers\AccountUserPermissionController')
                ->destroy($permission->id);
            /*return response()->json([
                'status' => 'success',
                'message' => 'Pomyślnie usunięto relację!',
            ])->setStatusCode(200);*/
        } catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Nie udało się usunąć relacji!',
            ])->setStatusCode(500);
        }

    }
}
