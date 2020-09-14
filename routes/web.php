<?php

use Illuminate\Support\Facades\Route;

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

//login
Route::get('/', 'LoginController@getLogin');
Route::post('/loginCheck', 'LoginController@loginCheck');

//register
Route::get('/register', 'LoginController@getRegister');
Route::post('/registerProcess', 'LoginController@store');

//logout
Route::get('/logout', 'LoginController@logout');

//dashboard
Route::get('/dashboard', 'PagesController@index');

//task
Route::get('/task', 'TasksController@index');
Route::get('/task/create', 'TasksController@create');
Route::post('/task/store', 'TasksController@store');
Route::delete('/task/{task}', 'TasksController@destroy');
Route::patch('/task/{task}', 'TasksController@update');

//profile
Route::get('/profile', 'ProfileController@index');
Route::patch('/profile/update', 'ProfileController@update');
Route::get('/changepassword', 'ProfileController@indexPassword');
Route::patch('/changepassword/update', 'ProfileController@updatePassword');
