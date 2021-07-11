<?php


namespace App\Repositories;

use App\Models\Kid;
use App\Models\Photo;
use App\Models\Post;
use App\Models\PostStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return $this->post->all();
    }

    public function store(Request $request)
    {
        $attributes = $request->validated();

        $default_pic = Kid::find($request['kid_id'])->avatar;

        $attributes['picture'] = $default_pic;

        try {
            $new_post = Post::create($attributes);

            $uploaded_picture = new Photo();

            $new_post->picture = $uploaded_picture->upload($request,Kid::find($request->kid_id)->account->id);

            $new_post->save();

            return $new_post;

        } catch(\Exception $e){

            error_log("Błąd zapisu posta:");

            error_log("Error message: " . $e->getMessage());

            return null;
        }

    }

    public function update(Request $request, Post $post){

        $post_picture = $post->picture;
        $post_kid_avatar = $post->kid->avatar;

        $edited_post = $post->fill($request->all());

        error_log("==================================================================");
        if($request->picture){

            error_log("Need to update picutre!!! Picture name:".$request->picture );

            $uploaded_picture = new Photo();

            $edited_post->picture = $uploaded_picture->upload($request,Kid::find($request->kid_id)->account->id);

            if(!($post_picture == $post_kid_avatar)){
                error_log("Uploaded picture replaces another (non default) picture");
                error_log("Old picture need to be removed");
                $picture_to_delete = new Photo();
                $picture_to_delete->unlinkPicture($post->kid->account_id,$post_picture);
            }

        } else {

            error_log("No picture to update");
            error_log("post->picture: ".$post_picture);
            error_log("post->kid->avatar: ".$post_kid_avatar);

            if($post->picture == $post->kid->avatar) {
                error_log("Picture is default");
                if (!($request->kid_id == $post->kid->id)) {

                    error_log("But kid was changed!!!!!!!!!!!!!!!!!");
                    $edited_post->picture = Kid::find($request->kid_id)->avatar;
                } else {
                    error_log("But kid hasn't change");
                }
            }
        }
        error_log("==================================================================");


        return $edited_post->save();
    }

    public function delete($id) {
        try {
            $post = $this->post->find($id);
            $post_picture = $post->picture;
            $post_kid = $post->kid;
            $post->delete();
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
        }
    }

    public function edit(Post $post)
    {
        return view('posts.edit',[
            'post'=> $post,
            'statuses'=> PostStatus::all(),
            'kids'=> $post->kid->account->kids
        ]);
    }

}
