<?php

use Illuminate\Http\Request;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['middleware' => ['web','auth:api']], function(){

	Route::get('v1/endpoint','ApiController@index');

	Route::post('v1/store', 'FeedController@store');
	Route::put('update/{locationID}', 'FeedController@update');
	Route::delete('v1/delete/{locationID}', 'FeedController@delete');

});

Route::get('v1/p/endpoint','ApiController@index');