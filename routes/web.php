<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[UserController::class, "showCorrectHomepage"])->name('home');

Route::get('/homepagefeed',[ProfileController::class,'homefeed'])->name('homefeed.show');

Route::post('/register',[UserController::class, 'register']);


Route::post('/login',[UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/p/create',[PostsController::class,'create']);
Route::post('/p',[PostsController::class,'store']);
Route::get('/p/create',[PostsController::class,'create']);

Route::post('/i',[ProfileController::class,'store']);


Route::get('/profile/{user}',[ProfileController::class,'index']);
Route::get('/profile/{user}/edit',[ProfileController::class,'edit'])->middleware('auth');
Route::post('/profile/{user}',[ProfileController::class,'update']);

Route::post('/create-follow/{user}',[FollowController::class, 'createFollow']);
Route::post('/remove-follow/{user}',[FollowController::class, 'removeFollow']);


Route::get('/profile/{user}/follower',[ProfileController::class,'profileFollower']);
Route::get('/profile/{user}/following',[ProfileController::class,'profileFollowing']);

//search
Route::get('/search',[UserController::class, 'search']);

Route::get('/messages',[MessagesController::class, 'inbox'])->name('messages.create');
Route::get('/profile/{user}/message',[MessagesController::class, 'message']);
Route::get('/messages/{user}', [MessagesController::class, 'show'])->name('messages.show');
Route::post('/messages/{user}',[MessagesController::class, 'store'])->name('messages.store');

Route::get('/verify/email/{token}', [UserController::class, 'verifyEmail'])->name('verify.email');



