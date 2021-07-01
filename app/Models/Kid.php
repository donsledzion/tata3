<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kid extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'first_name',
        'last_name',
        'dim_name',
        'birth_date',
        'about',
        'gender',
        'avatar',
    ];

    public function posts():hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function account():belongsTo
    {
        return $this->belongsTo(Account::class);
    }

}
