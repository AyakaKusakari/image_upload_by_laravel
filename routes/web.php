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

// トップページ
Route::get('/', 'UploadersController@index')->name('index');

// 確認ページ
Route::post('/confirm', 'UploadersController@confirm')->name('confirm');

// 完了ページ
Route::post('/complete', 'UploadersController@complete')->name('complete');