<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'inviting_id',
        'invited_id',
        'permission_id',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function inviting():belongsTo
    {
        return $this->belongsTo(User::class,'inviting_id');
    }

    public function invited():belongsTo
    {
        return $this->belongsTo(User::class,'invited_id');
    }

    public function account():belongsTo
    {
        return $this->belongsTo(Account::class,'account_id');
    }

    public function permission():belongsTo
    {
        return $this->belongsTo(Permission::class,'permission_id');
    }

}
