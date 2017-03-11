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
Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');

Route::get('/test', 'PostsController@test');
Route::post('/avatars', 'PostsController@upload');

Route::get('/user/{user}', 'UsersController@show');
Route::post('/user/{user}', 'UsersController@updateAvatar');
Route::get('/admin', 'UsersController@admin');

Route::get('/denied', 'HomeController@denied');

# Create new comment
Route::post('/comment/{post}', 'CommentsController@store');
# Like comment
Route::get('/comment/like/{comment}', 'CommentsController@ToggleLike');
# Like Post
Route::get('/posts/like/{post}', 'PostsController@ToggleLike');

# Create new post
Route::get('/post/new', 'PostsController@create');
Route::post('/post/new', 'PostsController@store');

# Edit post
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::patch('/posts/{post}', 'PostsController@update');

Route::delete('/posts/{post}', 'PostsController@destroy');

Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post}', 'PostsController@show');


Route::get('/posts/{post}/destroy', 'PostsController@destroy');


Auth::routes();
