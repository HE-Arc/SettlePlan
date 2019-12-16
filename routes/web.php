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
Route::get('/user/friend/accept_demand/{friend_id}', 'UserController@acceptDemand')->name('acceptDemand');
Route::get('/user/friend/delete_friend/{friend_id}', 'UserController@deleteFriend')->name('deleteFriend');
Route::get('/user/friends', 'UserController@friends')->name('friends');

Route::get('/tasks/deleteFile/{task_id}/{file_id}', 'TaskController@deleteFile')->name('deleteFile');

Route::resource('user', 'UserController');
Route::resource('categories', 'CategoryController');
Route::get('user/friend/{user_id}', 'CategoryController@showUser')->name('user.friends');
Route::get('user/friend/{user_id}/{category_id}', 'CategoryController@showUserCategory')->name('category.showUserCategory');;
Route::resource('tasks', 'TaskController')->except('index');

//Route::prefix('/categories/{id}')->group(function () {});
