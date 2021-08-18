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

//ROUTE POUR VERSION MOBILE
Route::post('login_ws','Auth\LoginController@login_ws');
Route::get('login_ws','Auth\LoginController@login_ws');

Route::post('logout','Auth\LoginController@logout_ws');

Route::get('/userinfos','ApiController@userinfos')->name('userinfos');
Route::get('/send','ApiController@savePerception')->name('savePerception');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
