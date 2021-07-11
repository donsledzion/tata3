<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\PhotoRequest;
use App\Models\Account;
use App\Models\Photo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PhotoController extends Controller
{

    protected PhotoService $photoService;

    public function __construct(PhotoService $photoService){
        $this->photoService = $photoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $photos = $this->photoService->index();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param
     * @return
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PhotoRequest  $request
     * @return Photo
     */
    public function store(PhotoRequest $request): RedirectResponse
    {
        return $this->photoService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id - account id
     * @return View - filled with responded data
     */
    public function edit($id): View
    {
        return view('accounts.edit', [
           'account' => $this->accountservice->show($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AccountRequest  $request
     * @param  $id - id of account being updated
     * @return RedirectResponse
     */
    public function update(AccountRequest $request, $id): RedirectResponse
    {

        $account = $this->accountservice->update($request,$id);
        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id - account ID
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
            return $this->accountservice->delete($id);
    }
}
