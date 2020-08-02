<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function() {
  Route::get('/get-user', 'UserController@getCurrentUserRole')->name('transaction');
  Route::get('/transaction', 'TransactionController@index')->name('transaction');
  Route::get('/transaction/{transaction}', 'TransactionController@show')->name('transaction.view');
  Route::group(['middleware' => 'admin'], function() {
    Route::delete('/transaction/delete/{id}', 'TransactionController@destroy')->name('transaction');
    Route::post('/transaction/{transaction}', 'TransactionController@update')->name('transaction.update');
    Route::post('/transaction', 'TransactionController@store')->name('transaction.create');

    Route::get('/users', 'UserController@index')->name('transaction');
    Route::get('/user/{user}', 'UserController@show')->name('transaction');
  });
  Route::post('/notes', 'NoteController@store')->name('transaction.create');
});
