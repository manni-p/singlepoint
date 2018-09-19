<?php

use Illuminate\Http\Request;

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

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('feed-list', 'FeedController@index')->middleware('auth')->name('feed.list');

Route::get('feed-list/import', 'FeedController@import')->middleware('auth')->name('feed.import');

Route::get('locations', 'LocationController@index')->middleware('auth')->name('location.list');

Route::get('refresh-cache', 'LocationController@refreshCache')->middleware('auth')->name('location.refresh');

Route::get('locations/{attraction_id}', 'LocationController@attraction')->middleware('auth')->name('location.attractions');

Route::post('toggle', 'LocationController@toggle')->middleware('auth');



//passport routes

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://laravel-passport.nhs/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://laravel-passport.nhs/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {

    $http = new GuzzleHttp\Client;

    $response = $http->post('http://laravel-passport.nhs/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '1',
            'client_secret' => 'xenj44cnmS5xgP6R9Ib8X1IS1rehbxVWr9xqecOA',
            'redirect_uri' => 'http://laravel-passport.nhs/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});