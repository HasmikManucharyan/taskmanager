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
Route::post('/home', 'HomeController@index')->name('home');
Route::get('admin', 'Auth\AdminLoginController@showLoginForm');
Route::post('/ajaxRequest', 'HomeController@ajaxRequestPost');
Route::post('/changePriority', 'HomeController@changePriorityPost');
Route::post('changeUserType', 'Auth\AdminLoginController@changeUserTypePost');
Route::post('addTask', 'HomeController@addTaskPost');
Route::post('getUsers', 'HomeController@getUsersPost');
Route::post('saveUser', 'HomeController@saveUserPost');
Route::post('admin', ['as'=>'admin','uses'=>'Auth\AdminLoginController@login']);