<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
        return $this->belongsToMany(User::class,'account_user_permission')->withPivot('account_id','user_id','permission_id');
    }

    public function kids():hasMany
    {
        return $this->hasMany(Kid::class);
    }

    public function posts():hasManyThrough
    {
        return $this->hasManyThrough(Post::class,Kid::class);
    }

    public function requests():hasMany
    {
        return $this->hasMany(RequestToFollow::class,'account_id');
    }

    public function permission(User $user)
    {
        if($this->users->contains($user)){
            return AccountUserPermission::where('account_id','=',$this->id)->where('user_id','=',$user->id)->first();
        }
        return null;
    }

    public function lastPost()
    {
        $posts = $this->posts;
        return $posts->SortByDesc("said_at")->first();
    }


}
