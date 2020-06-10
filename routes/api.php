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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->group(function () {
    Route::get('/novel/{id}', 'NovelsController@detail')->name('novel.detail');
    Route::get('/novels', 'NovelsController@lists')->name('novel.lists');

    Route::get('/classify', 'ClassifyController@lists')->name('classify.lists');
    Route::get('/classify/menu', 'ClassifyController@menus')->name('classify.menus');

    Route::get('/tags', 'TagsController@lists')->name('tags.lists');

});
