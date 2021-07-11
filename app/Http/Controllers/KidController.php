<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKidRequest;
use App\Models\Kid;
use App\Models\User;
use App\Services\KidService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KidController extends Controller
{

    protected KidService $kidService;

    public function __construct(KidService $kidService){
        $this->kidService = $kidService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $kids = $this->kidService->index();
        return view('kids.related',['kids' => $kids]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('kids.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreKidRequest $request
     * @return RedirectResponse
     */
    public function store(StoreKidRequest $request)
    {
        $this->kidService->store($request);
        return redirect(route('accounts.show',Auth::user()->isParentToAccount()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function show(Kid $kid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Kid  $kid
     * @return View
     */
    public function edit(Kid $kid):View
    {
        return $this->kidService->edit($kid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreKidRequest  $request
     * @param  Kid  $kid
     * @return View
     */
    public function update(StoreKidRequest $request, Kid $kid)
    {
        $this->kidService->update($request, $kid);

        return view('accounts.show',[
            'account'=>$kid->account
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Kid  $kid
     * @return Response
     */
    public function destroy(Kid $kid)
    {
        return $this->kidService->delete($kid);
    }
}
