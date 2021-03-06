<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use http\Env\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return $this->userService->index();
    }

    /**
     * Returns a list of users related with logged-in user
     *
     * @return BelongsToMany
     */
    public function indexRelated():BelongsToMany
    {
        return $this->userService->indexRelated();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Returns User given by e-mail adress
     *
     * @param  String  $email
     * @return JsonResponse
     */
    public function findByEmail($email):JsonResponse
    {
        error_log("=====================================");
        error_log("Got here!");
        error_log("=====================================");
        return $this->userService->findByEmail($email);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Wyst??pi?? b????d!'
            ])->setStatusCode(500);
        }

    }
}
