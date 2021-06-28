<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Services\KidService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param  Request
     * @return RedirectResponse
     */
    public function store(Request $request)
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
     * @param  \App\Models\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function edit(Kid $kid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kid $kid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kid $kid)
    {
        //
    }
}
