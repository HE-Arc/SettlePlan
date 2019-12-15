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

Route::resource('users', 'UserController');
Route::resource('category', 'CategoryController');
Route::resource('tasks', 'TaskController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/accept_demand/{friend_id}', 'UserController@acceptDemand')->name('acceptDemand');
Route::get('/users/delete_friend/{friend_id}', 'UserController@deleteFriend')->name('deleteFriend');
Route::get('/users/friends', 'UserController@friends')->name('friends');

Route::resource('files', 'FileController');
Route::resource('users', 'UserController');
Route::resource('category', 'CategoryController');

Route::get('/users/friends', 'UserController@friends');
Route::get('users/friend/{user_id}', 'CategoryController@showUser');
Route::get('users/friend/{user_id}/{category_id}', 'CategoryController@showUserCategory');



