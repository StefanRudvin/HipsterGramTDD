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

Route::resource('users',    'Api\UsersController');
Route::resource('comments', 'Api\CommentsController');

#Route::resource('posts',    'Api\PostsController');

Route::post('/posts/{post}', 'Api\PostsController@show');
Route::get('/posts/',        'Api\PostsController@index');

Route::get('/admin/',        'UsersController@admin');

Route::post('/users/{user}/toggleFollow', 'Api\UsersController@ToggleFollow');

#Route::resource('posts.comments', 'Api\PostsCommentsController');
#Route::resource('users.posts',    'Api\UsersPostsController');
#Route::resource('users.comments', 'Api\UsersCommentsController');

Route::post('/posts/{post}/comments', 'Api\PostsCommentsController@index');

Route::post('/posts/{post}/toggleLike', 'Api\PostsController@ToggleLike');
Route::post('/posts/{post}/isliked',    'Api\PostsController@isLiked');

Route::post('/comments/{comment}/toggleLike', 'Api\CommentsController@ToggleLike');
Route::post('/comments/{comment}/isliked',    'Api\CommentsController@isLiked');
