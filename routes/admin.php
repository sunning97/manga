<?php

use App\Models\Admin;
use \Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('activation/{token}', 'Admin\ActivationController@activateUser')->name('admin.activate');
Route::get('/login','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/login','Admin\LoginController@login')->name('admin.login.submit');
Route::get('/logout','Admin\LoginController@logout')->name('admin.logout');

Route::post('/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::post('/password/reset','Admin\ResetPasswordController@reset')->name('admin.password.reset');
Route::get('/password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset.request');

Route::middleware('login')->group(function (){
    View::composer(['*'],function ($view){
        if(Auth::guard('admin')->check()){
            $admins = Admin::where('id','!=',Auth::guard('admin')->user()->id)->get();
            $view->with('all_admin',$admins);
        }
    });

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
    Route::get('/message','Admin\MessageController@index')->name('admin.messages');
    Route::get('/message/{id}','Admin\MessageController@chatWith')->name('admin.messages.with');
    Route::post('/message/send','Admin\MessageController@send');

    // Axios

    Route::prefix('axios')->group(function (){
        Route::get('/permissions/{id}','Admin\AxiosController@permissions');
        Route::get('/roles','Admin\AxiosController@roles');
        Route::post('/role/search','Admin\AxiosController@searchRole');
        Route::get('/permissions-delete/{id}','Admin\AxiosController@deletePermission');
        Route::get('/provinces','Admin\AxiosController@provinces');
        Route::get('/districts/{id}','Admin\AxiosController@districts');
        Route::get('/wards/{id}','Admin\AxiosController@wards');
        Route::get('/authors','Admin\AxiosController@authors');
        Route::get('/genres','Admin\AxiosController@genres');
        Route::get('/mangas','Admin\AxiosController@mangas');
        Route::get('/delete-chap-image/{id}','Admin\AxiosController@deleteChapImage');
        Route::get('/chap-images/{id}','Admin\AxiosController@chapImages');
        Route::get('/authors-notin/{id}','Admin\AxiosController@authorsNotIn');
        Route::post('/author/get','Admin\AxiosController@getAuthor');
        Route::get('/genres-notin/{id}','Admin\AxiosController@genresNotIn');
        Route::get('/teams-notin/{id}','Admin\AxiosController@teamsNotIn');
        Route::post('/search-genres','Admin\AxiosController@searchGenre');
        Route::post('/search-permission','Admin\AxiosController@searchPermission');
        Route::post('/chap-image-edit','Admin\AxiosController@chapImageEdit');
        Route::get('/users','Admin\AxiosController@users');
        Route::post('/search-teams','Admin\AxiosController@searchTeams');
        Route::get('/translate-teams','Admin\AxiosController@teams');
        Route::post('/search-author','Admin\AxiosController@searchAuthor');
        Route::post('/all-contacts','Admin\AxiosController@getAllContacts');
        Route::post('/get-conversation','Admin\AxiosController@getConversation');
        Route::post('/get-admins','Admin\AxiosController@getAdmins');
        Route::get('/get-roles','Admin\AxiosController@getRoles');
        Route::post('/search-admin','Admin\AxiosController@searchAdmin');
        Route::post('/admin/check-email','Admin\AxiosController@checkEmailAdmin');
        Route::post('/admin/check-permission','Admin\AxiosController@checkPer');
    });
});