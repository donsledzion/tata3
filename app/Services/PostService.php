<?php


namespace App\Services;


use App\Models\Account;
use App\Models\Post;
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

        $user=User::find(Auth::id());
        $posts = $user->posts();



        $feed = '';
        if($request->ajax()) {
            foreach($posts as $post) {
                $posts_account = $post->kid->account;
                $is_related = $user->permission($posts_account);
                $feed.='<div class="h-auto px-2">
                <div class="max-w-md mx-auto bg-white shadow-lg rounded-md overflow-hidden md:max-w-md">
                    <div class="md:flex">
                        <div class="w-full">
                            <div class="flex justify-between items-center p-3">
                                <div class="flex flex-row items-center"> <img src="storage/'.$post->kid->account_id.'/160/'.$post->kid->avatar.'" class="rounded-full" width="40">
                                    <div class="flex flex-row items-center ml-2"> <span class="font-bold mr-1">'.$post->kid->dim_name.'</span> <small class="h-1 w-1 bg-gray-300 rounded-full mr-1 mt-1"></small>

                                        <button class="follow-button text-red-600 text-sm hover:text-red-800"
                                             data-account="'.$post->kid->account_id.'"
                                             data-user="'.$user->id.'"
                                             data-message="'.__('kidbook.request.default').'">
                                             <svg class="w-6 h-6" fill="';
                                             if($is_related){$feed.='red';} else {$feed.='none';}
                                             $feed.='" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                         </button>
                                    </div>
                                </div>
                                <div class="pr-2">';
                if($post->kid->account_id == Auth::user()->isParentToAccount()) {
                    $feed.='<a href="'.route('posts.edit',$post->id).'" class="bg-blue-500 p-2 edit text-white hover:shadow-lg text-xs font-thin" data-id="'.$post->id.'">'. __('Edit').'</a >
                            <button class="bg-red-500 p-2 delete text-white hover:shadow-lg text-xs font-thin" data-class="posts" data-id="'.$post->id.'" >'.__('Delete').'</button >';
                }
                            $feed.='<i class="fa fa-ellipsis-h text-gray-400 hover:cursor-pointer hover:text-gray-600"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-3">
                                <blockquote>
                                <i>'.nl2br(e($post->sentence)).'</i>
                                </blockquote>
                            </div>
                            <div> <img src="storage/'.$post->kid->account_id.'/480/'.$post->picture.'"  class="w-full h-75"> </div>
                            <div class="flex  right-0 p-2">
                                <p><b>'.$post->said_at.'</b></p>
                            </div>
                            <div class="flex  right-0 p-2">
                                <p><b>'.$post->kid->first_name.', '.$post->ageWhilePosting().'</b></p>
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

    public function delete($id)
    {
        return $this->post->delete($id);
    }

    public function edit(Post $post)
    {
        return $this->post->edit($post);
    }

    public function update(Request $request, Post $post)
    {
        return $this->post->update($request, $post);
    }

}
