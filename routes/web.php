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


/* Main routes */
Auth::routes();
Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');
Route::get('/denied', 'HomeController@denied');
Route::post('/avatars', 'PostsController@upload');

/* User routes */
Route::get('/admin', 'UsersController@admin');
Route::get('/user/{user}', 'UsersController@show');
Route::post('/user/{user}', 'UsersController@updateAvatar');
Route::get('/user/{user}/follow', 'UsersController@ToggleFollow');

/* Comment routes */

# Create new comment
Route::post('/comment/{post}', 'CommentsController@store');
# Like comment
Route::get('/comment/like/{comment}', 'CommentsController@ToggleLike');

/* Posts routes */

# Index & Show posts
Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post}', 'PostsController@show');
# Create new post
Route::get('/post/new', 'PostsController@create');
Route::post('/post/new', 'PostsController@store');
# Edit post
Route::patch('/posts/{post}', 'PostsController@update');
Route::get('/posts/{post}/edit', 'PostsController@edit');
# Delete post
Route::get('/posts/{post}/destroy', 'PostsController@destroy');
# Like post
Route::get('/posts/like/{post}', 'PostsController@ToggleLike');
