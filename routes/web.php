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

Route::get('register','Site\RegisterController@showRegistrationForm')->name('register');
Route::post('register','Site\RegisterController@register')->name('register.submit');
Route::get('register/success','Site\RegisterController@registerSuccess')->name('register.success');
Route::get('login','Site\LoginController@showloginForm')->name('login');
Route::post('login','Site\LoginController@login')->name('login.submit');
Route::get('logout','Site\LoginController@logout')->name('logout');
Route::get('activation/{token}', 'Site\ActivationController@activateUser')->name('site.activate');

Route::get('/','Site\HomeController@index')->name('home');
Route::get('manga/{slug}.{id}','Site\HomeController@detailManga')->name('home.manga');
Route::get('manga/{manga}/{chap_slug}.{id_chap}','Site\HomeController@chapManga')->name('home.manga.chap');

// route for axios site

Route::prefix('axios')->group(function (){
    Route::post('get-comment','Site\AxiosController@getComments');
    Route::post('get-child-comment','Site\AxiosController@getChildComments');
    Route::post('get-total-comments','Site\AxiosController@getTotalComments');
    Route::post('save-comment','Site\AxiosController@saveComment');
});
