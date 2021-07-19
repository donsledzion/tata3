<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestToFollow extends Model
{
    use HasFactory;

    protected $table="requests_to_follow";

    protected $fillable = [
        'account_id',
        'requesting_id',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user():belongsTo
    {
        return $this->belongsTo(User::class,'requesting_id');
    }

    public function account():belongsTo
    {
        return $this->belongsTo(Account::class,'account_id');
    }
}
