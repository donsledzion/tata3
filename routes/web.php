<?php

use App\Http\Controllers\AccountUserPermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UploadImageController;
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
//****************************************************************************************************************************
// Images routes
//****************************************************************************************************************************
Route::post('/image/account',       [UploadImageController::class, 'save'])->name('account.avatar')->middleware('auth');


Route::get('/',       [PostController::class, 'feedPosts'])->name('welcome')->middleware('auth');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

//****************************************************************************************************************************
// Post routes
//****************************************************************************************************************************
Route::get('/posts',            [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/postsfeed',        [PostController::class, 'feedPosts'])->name('postsfeed.index')->middleware('auth');


//****************************************************************************************************************************
// User routes
//****************************************************************************************************************************
Route::get('/users/list',       [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::delete('/users/{user}',  [UserController::class, 'destroy'])->middleware('auth');

//****************************************************************************************************************************
// Kid routes
//****************************************************************************************************************************
Route::get('/kids',             [KidController::class, 'index'])->name('kids.index')->middleware('auth');
Route::get('/kid/create',      [KidController::class, 'create'])->name('kids.create')->middleware('auth');

//****************************************************************************************************************************
// Account routes
//****************************************************************************************************************************
Route::get('/accounts',                 [AccountController::class, 'index'])->name('accounts.index')->middleware('auth');
Route::get('/account/create',          [AccountController::class, 'create'])->name('accounts.create')->middleware('auth');
Route::get('/accounts/{account}',       [AccountController::class, 'show'])->name('accounts.show')->middleware('auth');
Route::post('/accounts',                [AccountController::class, 'store'])->name('accounts.store')->middleware('auth');
Route::get('/accounts/edit/{account}',  [AccountController::class, 'edit'])->name('accounts.edit')->middleware('auth');
Route::post('/accounts/{account}',      [AccountController::class, 'update'])->name('accounts.update')->middleware('auth');
Route::delete('/accounts/{account}',    [AccountController::class, 'destroy'])->name('accounts.destroy')->middleware('auth');

//****************************************************************************************************************************
// AccountUserPermission routes
//****************************************************************************************************************************
Route::get('/accountuserpermission',[AccountUserPermissionController::class, 'store'])
    ->name('accountuserpermission.store')
    ->middleware('auth');

require __DIR__.'/auth.php';
