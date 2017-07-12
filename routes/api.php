<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', 'Api\UsersApiController');
Route::resource('comments', 'Api\CommentsApiController');
Route::resource('posts', 'Api\PostsApiController');

Route::resource('posts.comments', 'Api\PostsCommentsApiController');
Route::resource('users.posts', 'Api\UsersPostsApiController');
Route::resource('users.comments', 'Api\UsersCommentsApiController');

Route::get('/posts/{post}/like', 'Api\PostsApiController@ToggleLike');
Route::get('/posts/{post}/isliked', 'Api\PostsApiController@isLiked');

Route::get('/comments/{comment}/like', 'Api\CommentsApiController@ToggleLike');
Route::get('/comments/{comment}/isliked', 'Api\CommentsApiController@isLiked');
