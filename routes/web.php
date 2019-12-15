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

Route::get('/users/accepted_demand', 'UserController@acceptedDemand');
Route::get('/users/delete_friend', 'UserController@deleteFriend');

Route::get('/users/friends', 'UserController@friends');
Route::get('users/friend/{user_id}', 'CategoryController@showUser');
Route::get('users/friend/{user_id}/{category_id}', 'CategoryController@showUserCategory');



