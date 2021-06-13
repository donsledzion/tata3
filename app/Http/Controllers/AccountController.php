<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $result = Account::paginate(5);
        return view('accounts.index', [
            'accounts' => $result
        ]);
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
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $account = new Account($request->all());
        $account->save();
        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
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
     * @param  Account  $account
     * @return View
     */
    public function edit(Account $account): View
    {
        return view('accounts.edit', [
           'account' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return RedirectResponse
     */
    public function update(Request $request, Account $account): RedirectResponse
    {
        $account->fill($request->all());
        $account->save();
        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return : JsonResponse
     */
    public function destroy(Account $account): JsonResponse
    {
        try {
            $account->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
