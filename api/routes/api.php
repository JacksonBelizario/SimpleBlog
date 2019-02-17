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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/', function (Request $request) {
            return $request->user();
        });
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', 'PostsController@index');
        Route::post('/', 'PostsController@store');
        Route::put('/{id}', 'PostsController@update');
        Route::get('/{id}', 'PostsController@show');
        Route::delete('/{id}', 'PostsController@destroy');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', 'TagsController@index');
    });
});
