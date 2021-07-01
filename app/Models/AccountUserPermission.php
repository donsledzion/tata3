<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountUserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'user_id',
        'permission_id',
    ];

    protected $table="account_user_permission";

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }


}
