<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Account;
use App\Models\Post;
use App\Models\PostStatus;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $posts = $this->postService->index();
        return view("posts.index",['posts' => $posts]);

    }

    public function feedPosts(Request $request)
    {
        return $this->postService->feedPost($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $kids = (Account::find(Auth::user()->isParentToAccount()))->kids;
        $today = date("Y-m-d");
        $statuses = PostStatus::all();

        return view('posts.create',[
            'kids' => $kids,
            'said_at' => $today,
            'statuses'=> $statuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $this->postService->store($request);
        return redirect(route('postsfeed.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return View
     */
    public function edit(Post $post):View
    {
        return $this->postService->edit($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post):RedirectResponse
    {
        $this->postService->update($request, $post);
        return redirect(route('postsfeed.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function destroy($id):JsonResponse
    {
        return $this->postService->delete($id);
    }
}
