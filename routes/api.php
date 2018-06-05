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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('/v1/login', 'Api\AuthController@login');
    Route::post('/v1/logout', 'Api\AuthController@logout');
    Route::post('/v1/refresh', 'Api\AuthController@refresh');
    Route::post('/v1/register', 'Api\AuthController@register');
    Route::get('/v1/user', 'Api\UserController@getUser');
    // Books
    Route::get('/v1/books/all', 'Api\BookController@getAll');
});