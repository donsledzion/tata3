<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function kid():belongsTo
    {
        return $this->belongsTo(Kid::class);
    }

    public function post_status():belongsTo
    {
        return $this->belongsTo(PostStatus::class);
    }

}
