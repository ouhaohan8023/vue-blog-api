<?php

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

// 菜单
Route::prefix(config('admin.prefix'))->middleware([
    'auth',
    'admin'
])->namespace('Admin')->name('admin.')->group(function () {
    Route::prefix('novels')->name('novels.')->group(function () {
        Route::get('/', 'NovelsController@index')->name('');
        Route::get('/index', 'NovelsController@index')->name('index');
        Route::any('/create', 'NovelsController@create')->name('create');
        Route::post('/delete', 'NovelsController@delete')->name('delete');
        Route::any('/update/{id}', 'NovelsController@update')->name('update');
    });
});
