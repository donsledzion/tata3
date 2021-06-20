<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Function returns wheather user is already assigned as a parent within some aacount
     * @return bool
     *
     */

    public function isParent(): bool
    {
        $match = User::join('account_user_permission', 'account_user_permission.user_id','=','users.id')
            ->join('accounts', 'accounts.id','=','account_user_permission.account_id')
            ->join('permissions','permissions.id','=','account_user_permission.permission_id')
            ->where('permissions.name','=','permissions.parents')
            ->where('users.id','=',Auth::id())
            ->count();
        error_log("Count matches = ".$match);
        if($match>0) {
            return true;
        }
        return false;
    }

    public function accounts(){
        return $this->belongsToMany(User::class, 'account_user_permission');
    }
}
