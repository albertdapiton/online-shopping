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

#Route::middleware('auth:api')->get('/user', 'API\UserController@getUser');

Route::group([
    'namespace' => 'API',
], function () {
    Auth::routes(['verify' => true]);

    Route::group([
        'prefix' => 'user'
    ], function() {
        Route::get('verify', function() {
            return false;
        })->name('user.verify');
    });
});