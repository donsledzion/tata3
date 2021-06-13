<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Account extends Model
{
    use HasFactory;

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = [
    'name',
    'avatar',
];



/**
 * The attributes that should be cast to native types.
 *
 * @var array
 */
protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
];


        /**
         * Definition of many to many relationship between users and accounts
         *
         * @return BelongsToMany
         */
    public function users()
    {
        return $this->belongsToMany(User::class, 'account_user_permission');
    }

    public function kids()
    {
        return $this->hasMany(Kid::class);
    }

}