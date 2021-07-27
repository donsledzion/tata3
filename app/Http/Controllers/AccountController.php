<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\AccountUserPermission;
use App\Services\AccountService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{

    protected AccountService $accountservice;

    public function __construct(AccountService $accountservice){
        $this->accountservice = $accountservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $accounts = $this->accountservice->index();
        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AccountRequest  $request
     * @return RedirectResponse
     */
    public function store(AccountRequest $request): RedirectResponse
    {
        return $this->accountservice->store($request);

        //return redirect(route('accounts.show',[$account_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id): VIew
    {
        return $this->accountservice->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id - account id
     * @return View - filled with responded data
     */
    public function edit($id): View
    {
        return $this->accountservice->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AccountRequest  $request
     * @param  Account $account
     * @return RedirectResponse
     */
    public function update(AccountRequest $request, Account $account): RedirectResponse
    {
        return $this->accountservice->update($request,$account);
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
