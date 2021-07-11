<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function gender():hasOne
    {
        return $this->hasOne(Gender::class);
    }

    public function deleteWithPicture()
    {
        try {

            foreach($this->posts as $post){
                $post->deleteWithPicture();
            }

            $kid_avatar = $this->avatar;
            $kid = $this;
            $this->delete();

            $picture_to_delete = new Photo();

            $picture_to_delete->unlinkPicture($kid->account_id, $kid_avatar);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            error_log("==================================================================");
            error_log("Wyjebka przy usuwaniu Bombleka.");
            error_log("Error message: " . $e->getMessage());
            error_log("==================================================================");
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd!',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

}
