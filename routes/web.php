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

Route::get('/users', 'UsersController@test');
Route::get('/homeposts', 'PostsController@home');


Route::resource('posts', 'PostsController');


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


# Old Post routes

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
