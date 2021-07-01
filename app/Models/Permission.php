<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'allow_read',
        'allow_write',
        'allow_share',
    ];

    public function accounts():belongsToMany
    {
        return $this->belongsToMany(Account::class,'account_user_permission');
    }

    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class,'account_user_permission');
    }
}
