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

Route::get('/users/list', [UserController::class, 'index'])->middleware('auth');

Route::get('/kids', [KidController::class, 'index'])->name('kids.index')->middleware('auth');

Route::get('/accounts/list',    [AccountController::class, 'index'])->name('accounts.index')->middleware('auth');
Route::get('/accounts/create',  [AccountController::class, 'create'])->name('accounts.create')->middleware('auth');

require __DIR__.'/auth.php';
