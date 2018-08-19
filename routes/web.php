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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// users
Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store'] ]);

// search
Route::get('/search', 'SearchController@users');

// img
Route::get('/img/user-avatar/{id}/{size}', 'ImageController@user_avatar');

// friends
Route::get('users/{user}/friends', 'FriendController@index');
Route::post('/friends/{friend}', 'FriendController@store');
Route::patch('/friends/{friend}', 'FriendController@update');
Route::delete('/friends/{friend}', 'FriendController@destroy');

// Posts
Route::resource('/posts', 'PostsController', ['except' => ['index', 'create']]);

// Wall
Route::get('/wall', 'WallsController@index');

// comments
Route::resource('/comments', 'CommentsController', ['except' => ['index', 'create', 'show']]);
