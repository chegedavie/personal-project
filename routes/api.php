<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\ReceivedMessageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(CommentController::class)->group(function () {
    Route::get('comment/{comment}', 'index');
    Route::post('comment/', 'store');
    Route::delete('comment/{comment}', 'destroy');
    Route::get('comment/{comments}', 'show');
    Route::patch('comment/{comment}', 'update');
    Route::patch('comment/{comment}/clap', 'clap');
    Route::patch('comment/{comment}/unclap', 'unclap');
    Route::get('comment/{comment}/claps', 'claps');
    Route::patch('comment/{comment}/like', 'like');
    Route::patch('comment/{comment}/unlike', 'unlike');
});

Route::controller(PostController::class)->group(function () {
    Route::patch('blog/{blog}/clap', 'clap');
    Route::patch('blog/{blog}/unclap', 'unclap');
    Route::patch('blog/{blog}/like','like');
    Route::patch('blog/{blog}/unlike','unlike');
    Route::get('blog/{blog}/likes','likes');
    Route::get('blog/{blog}/claps', 'claps');
    Route::get('blog/featured','featured');
    Route::get('blog/search/{search}','searchPublished');
    Route::get('blog/search/all/{search}','searchAll');
    Route::get('blog/search/user/{search}','searchUserPosts');
    Route::get('blog/user/posts','userPosts');
    Route::patch('blog/{blog}/publish','publish');
	Route::patch('blog/{blog}/unpublish','unpublish');
    Route::patch('blog/{blog}/feature','setFeatured');
	Route::patch('blog/{blog}/unfeature','unsetFeatured');
    Route::get('blog/user/posts/{blog}','userPost')->middleware('can:update,blog');
	Route::get('blog/tag/{tag}/posts','tagPosts');
});

Route::resource('blog', PostController::class);
Route::resource('blog.comment', PostCommentController::class);
Route::resource('blog.tagPost', TagPostController::class);
Route::resource('tag', TagController::class);
Route::resource('message',ReceivedMessageController::class);
