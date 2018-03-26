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
Route::get('/posts/new', 'PostsController@create');

Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');

Route::get('/admin/', 'HomeController@admin');

Route::get('/git-pull/', 'HomeController@gitPull');

Route::get('/change-volume/{volume}', 'HomeController@changeVolume');

// # Like & Follow routes

// 	Route::get('/posts/{post}/like', 'PostsController@ToggleLike');
// 	Route::get('/posts/{post}/isliked', 'PostsController@isLiked');

// 	Route::get('/comments/{comment}/like', 'CommentsController@ToggleLike');
// 	Route::get('/comments/{comment}/isliked', 'CommentsController@isLiked');

// 	Route::get('/users/{user}/follow', 'UsersController@ToggleFollow');
// 	Route::get('/users/{user}/isfollowed', 'UsersController@isFollowed');


// /* Main routes */
Auth::routes();
Route::get('/', 'HomeController@welcome');
Route::get('/home', 'HomeController@index');
// 	Route::get('/denied', 'HomeController@denied');
// 	Route::get('/scrape', 'ScrapeController@scrape');
// 	Route::get('/users/{user}/getFollows', 'UsersController@getFollows');


// /* User routes */
// 	Route::get('/admin', 'OldUsersController@admin');
// 	Route::get('/user/{user}/follow', 'OldUsersController@ToggleFollow');