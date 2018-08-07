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

Route::get('login','Site\LoginController@showloginForm')->name('login');
Route::post('login','Site\LoginController@login')->name('login.submit');
Route::get('logout','Site\LoginController@logout')->name('logout');
Route::get('activation/{token}', 'Site\HomeController@activateUser')->name('site.activate');

Route::get('/','Site\HomeController@index')->name('home');
Route::get('manga/{slug}.{id}','Site\HomeController@detailManga')->name('home.manga');
Route::get('manga/{manga}/{chap_slug}.{id_chap}','Site\HomeController@chapManga')->name('home.manga.chap');