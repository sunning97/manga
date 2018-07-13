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
    return redirect()->route('manga.login');
});

Route::prefix('/manga')->group(function (){
    Route::get('/login','Manga\LoginController@index')->name('manga.login');
    Route::post('/login-process','Manga\LoginController@login_process')->name('manga.login.process');
    Route::get('/logout','Manga\LoginController@logout')->name('manga.logout');

    Route::middleware('login')->group(function (){
        Route::get('/','Manga\DashboardController@index')->name('manga.dashboard');

        Route::get('/admins/profile','Manga\AdminController@profile')->name('admin.profile');
        Route::resource('/admins','Manga\AdminController');
        Route::post('/admins/update-avatar','Manga\AdminController@updateAvatar')->name('admin.update-avatar');
        Route::post('/admins/update-password','Manga\AdminController@updatePassword')->name('admin.update-password');
        Route::post('/admins/update-profile','Manga\AdminController@updateProfile')->name('admin.profile.update');

        Route::resource('/permissions','Manga\PermissionController');
        Route::resource('/roles','Manga\RoleController');
        Route::resource('/mangas','Manga\MangaController');
        Route::resource('/genres','Manga\GenreController');
        Route::resource('/authors','Manga\AuthorController');
        Route::resource('/chaps','Manga\ChapController');
        Route::resource('/translate-teams','Manga\TranslateTeamController');
        Route::get('/mangas/create-chap/{id}','Manga\MangaController@createChap')->name('manga.chap.create');
        Route::post('/mangas/store-chap/{id}','Manga\MangaController@storeChap')->name('manga.chap.store');
        Route::post('/roles/update-permission/{id}','Manga\RoleController@update_permission')->name('manga.update.role.permission');
        Route::post('/chaps-images/{id}','Manga\ChapController@image')->name('chaps.image');

        // Axios

        Route::get('/axios/permissions/{id}','Manga\AxiosController@permissions');
        Route::get('/axios/permissions-delete/{id}','Manga\AxiosController@deletePermission');
        Route::get('/axios/provinces','Manga\AxiosController@provinces');
        Route::get('/axios/districts/{id}','Manga\AxiosController@districts');
        Route::get('/axios/wards/{id}','Manga\AxiosController@wards');
        Route::get('/axios/authors','Manga\AxiosController@authors');
        Route::get('/axios/genres','Manga\AxiosController@genres');
        Route::get('/axios/mangas','Manga\AxiosController@mangas');
        Route::get('/axios/delete-chap-image/{id}','Manga\AxiosController@deleteChapImage');
        Route::get('/axios/chap-images/{id}','Manga\AxiosController@chapImages');
        Route::get('/axios/authors-notin/{id}','Manga\AxiosController@authorsNotIn');
        Route::get('/axios/genres-notin/{id}','Manga\AxiosController@genresNotIn');
        Route::get('/axios/teams-notin/{id}','Manga\AxiosController@teamsNotIn');
        Route::post('/axios/search-genres','Manga\AxiosController@searchGenre');
        Route::post('/axios/search-permission','Manga\AxiosController@searchPermission');
        Route::post('/axios/chap-image-edit','Manga\AxiosController@chapImageEdit');
        Route::get('/axios/users','Manga\AxiosController@users');
        Route::post('/axios/search-teams','Manga\AxiosController@searchTeams');
        Route::get('/axios/translate-teams','Manga\AxiosController@teams');
        Route::post('/axios/search-author','Manga\AxiosController@searchAuthor');
    });
});