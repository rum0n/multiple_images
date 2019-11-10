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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/picture', 'PictureController@index')->name('pic_form');

Route::post('/picture/upload', 'PictureController@upload')->name('pic_upload');

Route::get('/picture/delete/{del_id}', 'PictureController@delete')->name('pic_delete');


