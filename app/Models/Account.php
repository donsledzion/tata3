<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'bio',
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
    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class, 'account_user_permission')->withPivot('permission_id');
    }

    public function kids():hasMany
    {
        return $this->hasMany(Kid::class);
    }

}
