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

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', 	 		 'AdminController@index')->name('index');
Route::get('login', 	 		 'AdminController@login')->name('login');
Route::get('logout', 	 		 'AdminController@logout')->name('logout');
Route::get('home', 	 			 'AdminController@home')->name('home');
Route::post('autenticar', 	     'AdminController@autenticar')->name('autenticar');
Route::get('cinemas', 	 		 'AdminController@cinemas')->name('cinemas');
Route::get('cinemas/room', 	 	 'AdminController@cinemas_room')->name('cinemas/room');
Route::get('seats', 	 		 'AdminController@seats')->name('seats');
Route::get('users', 	 		 'AdminController@users')->name('users');
