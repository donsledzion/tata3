<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Builder;

class AccountUserPermission extends Pivot
{
    /**
     * Class represents relation between users and family accounts
     * Any User can be related with many accounts.
     * Any (family) Account can be related with many users
     * Permission table represents privileges of user within specific family account
     * In separate table "permissions" are predefined actions allowed for specific roles ("permissions")
     * */
    use HasFactory;

    protected $fillable = [
        'account_id',
        'user_id',
        'permission_id',
    ];

    protected $table="account_user_permission";

    public $timestamps = false;


    public function permission():hasOne
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }

    public function account():hasOne
    {
        return $this->hasOne(Account::class,'id','account_id');
    }

    public function user():hasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }


}
