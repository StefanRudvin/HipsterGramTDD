<?php

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

Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');

Route::post('/comments', 'CommentsController@store');

Route::get('/posts/{post}/like', 'PostsController@ToggleLike');
Route::get('/posts/{post}/isliked', 'PostsController@isLiked');

Route::get('/comments/{comment}/like', 'CommentsController@ToggleLike');
Route::get('/comments/{comment}/isliked', 'CommentsController@isLiked');

Route::get('/users/{user}/posts', 'UsersController@getPosts');
Route::get('/users/{user}/comments', 'UsersController@getComments');


/* Main routes */
Auth::routes();
Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');
Route::get('/denied', 'HomeController@denied');
Route::get('/search', 'HomeController@search');
Route::post('/avatars', 'PostsController@upload');

Route::get('/homeposts', 'PostsController@home');

/* User routes */
Route::get('/admin', 'OldUsersController@admin');
Route::get('/user/{user}', 'OldUsersController@show');
Route::post('/user/{user}', 'OldUsersController@updateAvatar');
Route::get('/user/{user}/follow', 'OldUsersController@ToggleFollow');








# Create new comment
Route::post('/Comment/{post}', 'OldCommentsController@store');
# Like comment
Route::get('/Comment/like/{comment}', 'OldCommentsController@ToggleLike');

Route::get('/Posts', 'OldPostsController@index');
Route::get('/Posts/{post}', 'OldPostsController@show');
# Create new post
Route::get('/Post/new', 'OldPostsController@create');
Route::post('/Post/new', 'OldPostsController@store');
# Edit post
Route::patch('/Posts/{post}', 'OldPostsController@update');
Route::get('/Posts/{post}/edit', 'OldPostsController@edit');
# Delete post
Route::get('/Posts/{post}/destroy', 'OldPostsController@destroy');
# Like post
Route::get('/Posts/like/{post}', 'OldPostsController@ToggleLike');
