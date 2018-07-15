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

Route::get('/',function (){
    return redirect()->route('admin.login');
});

Route::prefix('/admin')->group(function (){
    Route::get('/login','Admin\LoginController@index')->name('admin.login');
    Route::post('/login-process','Admin\LoginController@login_process')->name('admin.login.process');
    Route::get('/logout','Admin\LoginController@logout')->name('admin.logout');

    Route::middleware('login')->group(function (){
        Route::get('/','Admin\DashboardController@index')->name('admin.dashboard');

        Route::get('/admins/profile','Admin\AdminController@profile')->name('admin.profile');
        Route::resource('/admins','Admin\AdminController');
        Route::post('/admins/update-avatar','Admin\AdminController@updateAvatar')->name('admin.update-avatar');
        Route::post('/admins/update-password','Admin\AdminController@updatePassword')->name('admin.update-password');
        Route::post('/admins/update-profile','Admin\AdminController@updateProfile')->name('admin.profile.update');

        Route::resource('/permissions','Admin\PermissionController');
        Route::resource('/roles','Admin\RoleController');
        Route::resource('/mangas','Admin\MangaController');
        Route::resource('/genres','Admin\GenreController');
        Route::resource('/authors','Admin\AuthorController');
        Route::resource('/chaps','Admin\ChapController');
        Route::resource('/translate-teams','Admin\TranslateTeamController');
        Route::get('/mangas/create-chap/{id}','Admin\MangaController@createChap')->name('admin.chap.create');
        Route::post('/mangas/store-chap/{id}','Admin\MangaController@storeChap')->name('admin.chap.store');
        Route::post('/roles/update-permission/{id}','Admin\RoleController@update_permission')->name('admin.update.role.permission');
        Route::post('/chaps-images/{id}','Admin\ChapController@image')->name('chaps.image');

        // Axios

        Route::get('/axios/permissions/{id}','Admin\AxiosController@permissions');
        Route::get('/axios/permissions-delete/{id}','Admin\AxiosController@deletePermission');
        Route::get('/axios/provinces','Admin\AxiosController@provinces');
        Route::get('/axios/districts/{id}','Admin\AxiosController@districts');
        Route::get('/axios/wards/{id}','Admin\AxiosController@wards');
        Route::get('/axios/authors','Admin\AxiosController@authors');
        Route::get('/axios/genres','Admin\AxiosController@genres');
        Route::get('/axios/mangas','Admin\AxiosController@mangas');
        Route::get('/axios/delete-chap-image/{id}','Admin\AxiosController@deleteChapImage');
        Route::get('/axios/chap-images/{id}','Admin\AxiosController@chapImages');
        Route::get('/axios/authors-notin/{id}','Admin\AxiosController@authorsNotIn');
        Route::get('/axios/genres-notin/{id}','Admin\AxiosController@genresNotIn');
        Route::get('/axios/teams-notin/{id}','Admin\AxiosController@teamsNotIn');
        Route::post('/axios/search-genres','Admin\AxiosController@searchGenre');
        Route::post('/axios/search-permission','Admin\AxiosController@searchPermission');
        Route::post('/axios/chap-image-edit','Admin\AxiosController@chapImageEdit');
        Route::get('/axios/users','Admin\AxiosController@users');
        Route::post('/axios/search-teams','Admin\AxiosController@searchTeams');
        Route::get('/axios/translate-teams','Admin\AxiosController@teams');
        Route::post('/axios/search-author','Admin\AxiosController@searchAuthor');
    });
});