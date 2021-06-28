<?php


namespace App\Repositories;

use App\Http\Controllers\UploadImageController;
use App\Models\Kid;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use App\Services\UploadImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    protected Post $post;

    public function __construct(Post $post){
        $this->post = $post;
    }

    public function find($id){
        return $this->post->find($id);
    }

    public function all() {
        if(Auth::user()->isAdmin()) {
            return Post::join('kids','kids.id','=','posts.kid_id')
                ->join('accounts','accounts.id','=','kids.account_id')
                ->select('posts.*','kids.first_name as kid_first_name',
                    'kids.last_name as kid_last_name',
                    'kids.dim_name as kid_dim_name',
                    'kids.avatar as kid_default_picture',
                    'kids.account_id as kid_account_id')
                ->orderby('posts.said_at','desc')
                ->get();
        } else {
            return User::join('account_user_permission','account_user_permission.user_id','=','users.id')
                ->join('permissions','permissions.id','=','account_user_permission.permission_id')
                ->join('accounts','accounts.id','=','account_user_permission.account_id')
                ->join('kids','kids.account_id','=','accounts.id')
                ->join('posts','posts.kid_id','=','kids.id')
                ->join('kids as kids_post','kids_post.id','=','posts.kid_id')
                ->where('permissions.allow_read','=','1')
                ->where('users.id','=',Auth::id())
                ->select('posts.*','kids.first_name as kid_first_name',
                    'kids.last_name as kid_last_name',
                    'kids.dim_name as kid_dim_name',
                    'kids.avatar as kid_default_picture',
                    'kids_post.account_id as kid_account_id')
                ->orderby('posts.said_at','desc')
                ->paginate(10);
        }
    }

    public function update($id, array $attributes){
        return $this->post->find($id)->update($attributes);
    }

    public function delete($id) {
            return $this->post->find($id)->delete();
    }

    public function store(Request $request)
    {
        $attributes = $request->all();

        $attributes['author_id'] = Auth::id();
        $default_pic = Kid::find($request['kid_id'])->avatar;
        $attributes['picture'] = $default_pic;
        try {
            $newPost = Post::create($attributes);
            if(!empty($request->file('avatar'))){
                try{
                    $uploadedImage = (new UploadImageController(new UploadImageService(new Photo())))->save($request);

                    $target_name = date("Ymd").date("His").".".$request->file('avatar')->extension();

                    $newPost->picture = $target_name;

                } catch(\Exception $e){
                    error_log("Błąd wysyłania plików na serwer:");
                    error_log("Error message: " . $e->getMessage());
                }
            } else {
                error_log("Nie ma fotki!");
            }

            $newPost->save();
        } catch(\Exception $e){
            error_log("Błąd zapisu posta:");
            error_log("Error message: " . $e->getMessage());
        }

        (new UploadImageController(new UploadImageService(new Photo())))->organizePictures($uploadedImage->id, $target_name, Auth::user()->isParentToAccount());

        return $newPost;
    }

}
