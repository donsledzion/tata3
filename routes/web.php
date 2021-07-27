<?php

use App\Http\Controllers\AccountUserPermissionController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RequestToFollowController;
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


Route::get('/',                     [PostController::class, 'feedPosts'])->name('welcome')->middleware('auth');


//****************************************************************************************************************************
// Post routes
//****************************************************************************************************************************
Route::get('/posts',                [PostController::class, 'index'])->name('posts.index')->middleware('auth','admin');
Route::get('/postsFeed',            [PostController::class, 'feedPosts'])->name('postsFeed.index')->middleware('auth');
Route::get('/postsFeed/kid/{kid}',  [PostController::class, 'feedPosts'])->name('postsFeed.byKid')->middleware('auth');
Route::get('/post/create',          [PostController::class, 'create'])->name('posts.create')->middleware('auth','publisher');
Route::post('/posts',               [PostController::class, 'store'])->name('posts.store')->middleware('auth','publisher');
Route::get('/posts/edit/{post}',    [PostController::class, 'edit'])->name('posts.edit')->middleware('auth','publisher');
Route::delete('/posts/{post}',      [PostController::class, 'destroy'])->middleware('auth','publisher');
Route::post('/posts/{post}',        [PostController::class, 'update'])->name('posts.update')->middleware('auth','publisher');


//****************************************************************************************************************************
// User routes
//****************************************************************************************************************************
Route::get('/users/list',                       [UserController::class, 'index'])->name('users.index')->middleware('auth','admin');
Route::get('/users/find_by_email/{email}',      [UserController::class, 'findByEmail'])->name('users.find.email')->middleware('auth');
Route::delete('/users/{user}',                  [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth','admin');


//****************************************************************************************************************************
// Kid routes
//****************************************************************************************************************************
Route::get('/kids',             [KidController::class, 'index'])->name('kids.index')->middleware('auth','has_kids');
Route::get('/kid/create',       [KidController::class, 'create'])->name('kids.create')->middleware('auth','parent');
Route::post('/kids',            [KidController::class, 'store'])->name('kids.store')->middleware('auth','parent');
Route::get('/kids/edit/{kid}',  [KidController::class, 'edit'])->name('kids.edit')->middleware('auth','parent');
Route::post('/kids/{kid}',      [KidController::class, 'update'])->name('kids.update')->middleware('auth','parent');
Route::delete('/kids/{kid}',    [KidController::class, 'destroy'])->name('kids.destroy')->middleware('auth','parent');

//****************************************************************************************************************************
// Account routes
//****************************************************************************************************************************
Route::get('/accounts',                 [AccountController::class, 'index'])->name('accounts.index')->middleware('auth');
Route::get('/account/create',           [AccountController::class, 'create'])->name('accounts.create')->middleware('auth','accountless');
Route::get('/accounts/{account}',       [AccountController::class, 'show'])->name('accounts.show')->middleware('auth');
Route::post('/accounts',                [AccountController::class, 'store'])->name('accounts.store')->middleware('auth','accountless');
Route::get('/accounts/edit/{account}',  [AccountController::class, 'edit'])->name('accounts.edit')->middleware('auth','parent');
Route::post('/accounts/{account}',      [AccountController::class, 'update'])->name('accounts.update')->middleware('auth','parent');
Route::delete('/accounts/{account}',    [AccountController::class, 'destroy'])->name('accounts.destroy')->middleware('auth','parent');

//****************************************************************************************************************************
// AccountUserPermission routes
//****************************************************************************************************************************
Route::get('/accountuserpermission',[AccountUserPermissionController::class, 'store'])
    ->name('accountuserpermission.store')
    ->middleware('auth');
Route::put('/accountuserpermission/{accountuserpermisson}',[AccountUserPermissionController::class, 'update'])
    ->name('accountuserpermission.update')
    ->middleware('auth','parent');


//****************************************************************************************************************************
// Friends routes
//****************************************************************************************************************************
Route::get('/friends',                  [FriendController::class, 'index'])->name('friends.index')->middleware('auth');
Route::post('/friends/{invitation}',    [FriendController::class, 'store'])->name('friends.store')->middleware('auth');
Route::delete('/friends/{friend}',      [FriendController::class, 'destroy'])->name('friends.destroy')->middleware('auth');

//****************************************************************************************************************************
// Invitations routes
//****************************************************************************************************************************
Route::post('/invitations',                [InvitationController::class, 'store'])->name('invitations.store')->middleware('auth');
Route::post('/invitations/{invitation}',   [InvitationController::class, 'accept'])->name('invitations.accept')->middleware('auth');
Route::delete('/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy')->middleware('auth');


//****************************************************************************************************************************
// RequestToFollow routes
//****************************************************************************************************************************
Route::post('/requeststofollow',                        [RequestToFollowController::class, 'store'])->name('requeststofollow.store')->middleware('auth');
Route::post('/requeststofollow/{requesttofollow}',      [RequestToFollowController::class, 'accept'])->name('requeststofollow.accept')->middleware('auth');
Route::delete('/requeststofollow/{requesttofollow}',    [RequestToFollowController::class, 'destroy'])->name('requeststofollow.destroy')->middleware('auth');


require __DIR__.'/auth.php';
