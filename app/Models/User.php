<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

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

    public function isParent(): bool // need to move method to services
    {
        $match = User::join('account_user_permission', 'account_user_permission.user_id','=','users.id')
            ->join('accounts', 'accounts.id','=','account_user_permission.account_id')
            ->join('permissions','permissions.id','=','account_user_permission.permission_id')
            ->where('permissions.name','=','permissions.parents')
            ->where('users.id','=',$this->id)
            ->count();
        if($match>0) {
            return true;
        }
        return false;
    }

    public function isParentToAccount()
    {
        $account = User::join('account_user_permission','account_user_permission.user_id','=','users.id')
            ->join('permissions','permissions.id','=','account_user_permission.permission_id')
            ->join('accounts','accounts.id','=','account_user_permission.account_id')
            ->where('users.id','=',$this->id)
            ->where('permissions.name','permissions.parents')
            ->select('accounts.*')
            ->first();

        if($account) {
            return $account['id'];
        }
        else return null;
    }

    public function isAdmin(): bool // need to move method to services
    {
        $match = User::join('admins','admins.user_id','=','users.id')
            ->where('users.id','=',$this->id)
            ->count();
        if($match>0) {
            return true;
        }
        return false;
    }

    public function accounts():belongsToMany
    {
        return $this->belongsToMany(Account::class,'account_user_permission')->withPivot('permission_id');
    }

    public function created_posts():hasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function kids()
    {
        if($this->accounts) {
            $this->load(['accounts.kids' => function ($query) use (&$kids) {
                $kids = $query->get()->unique();
            }]);
            if ($kids) {
                return $kids;
            }
        }
        return null;
    }

    public function posts()
    {
        $this->load(['accounts.posts'=> function($query) use (&$posts){

            $posts = $query->orWhere('status_id','=','4')->orderBy('said_at','desc')->paginate(10)->unique();
        }]);

        if(!empty($posts)) {
            try {
                $related_post = $posts->filter(function ($value, $key) {

                    if(($value->status_id = 4)|| ($value->status_id >= $value->kid->account->users->where('id', '=', Auth::id())->first()->pivot->permission_id)) {
                        return true;
                    }
                });
            } catch(\Exception $e){
                error_log("Błąd filtrowania postów!");
                error_log("Error message: ".$e->getMessage());
                return null;
            }
            return $related_post->all();
        }
        return null;
    }
}
