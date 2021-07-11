<?php

namespace App\Http\Middleware;

use App\Models\AccountUserPermission;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllowedToPublish
{
    /**
     * Handle an incoming request.
     * This middleware checks whether logged-in user is related with any account and:
     * 1) has "write" permissions within this account
     * 2) this account has kids to quote
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $permissions = AccountUserPermission::whereHas('permission', function(Builder $query){
            $query->where('allow_write','=','1');
        })->has('account.kids')
            ->where('user_id','=',Auth::id())->count();

        if($permissions>0) {
            return $next($request);
        }
        return redirect(route('welcome'));
    }
}
