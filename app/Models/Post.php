<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function status():hasOne
    {
        return $this->hasOne(PostStatus::class);
    }

    public function deleteWithPicture(){
        try {

            $post_picture = $this->picture;
            $post_kid = $this->kid;
            $this->delete();
            if(!($post_picture == $post_kid->avatar)){

                $picture_to_delete = new Photo();
                $picture_to_delete->unlinkPicture($post_kid->account_id,$post_picture);

            }

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e){
            error_log("==================================================================");
            error_log("Wyjebka przy usuwaniu pliku.");
            error_log("Error message: ".$e->getMessage());
            error_log("==================================================================");
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd!',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        };
    }

    public function ageWhilePosting(){

        $said_at = Carbon::createFromDate($this->said_at);
        $birth_date = Carbon::createFromDate($this->kid->birth_date);

        $diffInMonths = $said_at->diffInMonths($birth_date) ;

        if($diffInMonths < 24){
            if($diffInMonths > 21) {
                return $diffInMonths." miesięce";
            } else {
                return $diffInMonths . " miesiący";
            }
        } else {

            return "lat ".$said_at->diffInYears($birth_date) ;
        }

    }

}
