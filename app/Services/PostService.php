<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{

    public function __construct(PostRepository $post){
        $this->post = $post;
    }

    public function index() {
        return $this->post->all();
    }

    public function feedPost(Request $request){
        $posts = $this->post->related();
        $feed = '';
        if($request->ajax()) {
            foreach($posts as $post) {
                $feed.='<div class="h-auto px-2">
                <div class="max-w-md mx-auto bg-white shadow-lg rounded-md overflow-hidden md:max-w-md">
                    <div class="md:flex">
                        <div class="w-full">
                            <div class="flex justify-between items-center p-3">
                                <div class="flex flex-row items-center"> <img src="storage/'.$post->kid_account_id.'/160/'.$post->kid_default_picture.'" class="rounded-full" width="40">
                                    <div class="flex flex-row items-center ml-2"> <span class="font-bold mr-1">'.$post->kid_dim_name.'</span> <small class="h-1 w-1 bg-gray-300 rounded-full mr-1 mt-1"></small> <a href="#" class="text-blue-600 text-sm hover:text-blue-800">Follow</a> </div>
                                </div>
                                <div class="pr-2"> <i class="fa fa-ellipsis-h text-gray-400 hover:cursor-pointer hover:text-gray-600"></i> </div>
                            </div>
                            <div class="flex justify-between items-center p-3">
                                <blockquote>
                                <i>'.$post->sentence.'</i>
                                </blockquote>
                            </div>
                            <div> <img src="storage/'.$post->kid_account_id.'/480/'.$post->picture.'"  class="w-full h-75"> </div>
                            <div class="flex flex-row right-0 p-2">
                                <b>'.$post->said_at.'</b>
                            </div>
                            <div class="p-4 flex justify-between items-center">
                                <div class="flex flex-row items-center"> <i class="fa fa-heart-o mr-2 fa-1x hover:text-gray-600"></i> <i class="fa fa-comment-o mr-2 fa-1x hover:text-gray-600"></i> <i class="fa fa-send-o mr-2 fa-1x hover:text-gray-600"></i> </div>
                                <div> <i class="fa fa-bookmark-o fa-1x hover:text-gray-600"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-20 px-2">
            </div>';
            }
            return $feed;
        }
        return view("posts.index");
    }

    public function store(Request $request)
    {
        $newPost = $this->post->store($request);

        return $newPost;
    }

}
