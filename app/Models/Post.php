<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'said_at',
        'author_id',
        'kid_id',
        'sentence',
        'picture',
        'status_id',
    ];

    protected $casts = [
        'created_at',
        'updated_at',
    ];

}
