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
        error_log("jestem w kontrolerze AccountController");

        $this->accountservice->store($request);

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Account  $account
     * @return View
     */
    public function show(Account $account): VIew
    {
        return view("accounts.show", [
            'account' => $account
        ] );
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
        try {
            $this->accountservice->delete($id);
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd!',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
