<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('bilboards',		'BilboardController');
Route::resource('cinemas',		    'CinemaController');
Route::resource('cinema/room',		'CinemaRoomController');
Route::resource('clients',		    'ClientController');
Route::resource('departaments',		'DepartamentController');
Route::resource('municipalitys',	'MunicipalityController');
Route::resource('detail/invoice',	'DetailInvoiceController');
Route::resource('invoices',		    'InvoiceController');
Route::resource('movies',		    'MovieController');
Route::resource('seats',		    'SeatController');
Route::resource('seat/invoice',		'SeatInvoiceController');
Route::resource('users',		    'UserController');
Route::post('list/cinemas', 		'CinemaController@list');
Route::post('list/movies', 			'MovieController@list');
Route::post('view/bilboard', 		'BilboardController@view_bilboard');
Route::post('detail/movie', 		'MovieController@detail');