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

# Resource routes

	Route::resource('posts', 'PostsController');
	Route::resource('comments', 'CommentsController');
	Route::resource('users', 'UsersController');

# Like & Follow routes

	Route::get('/posts/{post}/like', 'PostsController@ToggleLike');
	Route::get('/posts/{post}/isliked', 'PostsController@isLiked');

	Route::get('/comments/{comment}/like', 'CommentsController@ToggleLike');
	Route::get('/comments/{comment}/isliked', 'CommentsController@isLiked');

	Route::get('/users/{user}/follow', 'UsersController@ToggleFollow');
	Route::get('/users/{user}/isfollowed', 'UsersController@isFollowed');


/* Main routes */
	Auth::routes();
	Route::get('/', 'HomeController@welcome');
	Route::get('/home', 'HomeController@index');
	Route::get('/denied', 'HomeController@denied');
	Route::get('/scrape', 'ScrapeController@scrape');
	Route::get('/users/{user}/getFollows', 'UsersController@getFollows');


/* User routes */
	Route::get('/admin', 'OldUsersController@admin');
	Route::get('/user/{user}/follow', 'OldUsersController@ToggleFollow');








##### Old Routes #####

Route::post('/user/{user}', 'OldUsersController@updateAvatar');

Route::get('/user/{user}', 'OldUsersController@show');

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
