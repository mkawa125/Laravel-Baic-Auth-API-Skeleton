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

Route::middleware('auth:api', 'jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('API')->prefix('v1')->group(function () {
    Route::post('login', 'ApiLoginController@login');
    Route::get('login/{provider}', 'ApiLoginController@redirect');
    Route::get('login/callback/{provider}', 'ApiLoginController@handleCallback');
    Route::post('register', 'ApiRegisterController@register');

    Route::middleware(['cors', 'jwt.auth'])->group(function (){
        Route::post('contacts', 'Users\messageController@contactMessage')->name('contact-us');

    });
});
