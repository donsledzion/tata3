<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\KidController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

//****************************************************************************************************************************
// User routes
//****************************************************************************************************************************
Route::get('/users/list',       [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::delete('/users/{user}',  [UserController::class, 'destroy'])->middleware('auth');

//****************************************************************************************************************************
// Kid routes
//****************************************************************************************************************************
Route::get('/kids',             [KidController::class, 'index'])->name('kids.index')->middleware('auth');
Route::get('/kids/create',      [KidController::class, 'create'])->name('kids.create')->middleware('auth');

//****************************************************************************************************************************
// Account routes
//****************************************************************************************************************************
Route::get('/accounts',                 [AccountController::class, 'index'])->name('accounts.index')->middleware('auth');
Route::get('/accounts/{account}',       [AccountController::class, 'show'])->name('accounts.show')->middleware('auth');
Route::get('/accounts/create',          [AccountController::class, 'create'])->name('accounts.create')->middleware('auth');
Route::post('/accounts',                [AccountController::class, 'store'])->name('accounts.store')->middleware('auth');
Route::get('/accounts/edit/{account}',  [AccountController::class, 'edit'])->name('accounts.edit')->middleware('auth');
Route::post('/accounts/{account}',      [AccountController::class, 'update'])->name('accounts.update')->middleware('auth');
Route::delete('/accounts/{account}',    [AccountController::class, 'destroy'])->name('accounts.destroy')->middleware('auth');

require __DIR__.'/auth.php';
