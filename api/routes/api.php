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
    return "API";
});

Route::post('/login', 'AuthController@auth');

Route::prefix('posts')->group(function () {
    Route::get('/', 'PostsController@index');
    Route::middleware('auth')->get('/all', 'PostsController@dashIndex');
    Route::middleware('auth')->post('/', 'PostsController@store');
    Route::middleware('auth')->put('/{id}', 'PostsController@update');
    Route::get('/{id}', 'PostsController@show');
    Route::middleware('auth')->delete('/{id}', 'PostsController@destroy');
});

Route::middleware('auth')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/', function (Request $request) {
            return $request->user();
        });
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', 'TagsController@index');
    });

    Route::prefix('authors')->group(function () {
        Route::get('/', 'AuthorsController@index');
    });
});
