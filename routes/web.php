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
| contains the "web" middleware group. Now create something great!
|
*/
// Route for public site
Route::get('/login','Site\LoginController@showloginForm')->name('login');
Route::post('/login','Site\LoginController@login')->name('login.submit');
Route::get('/logout','Site\LoginController@logout')->name('logout');
Route::get('/','Site\HomeController@index')->name('home');
Route::get('activation/{token}', 'Site\HomeController@activateUser')->name('site.activate');


// Route for admin controll panel
Route::prefix('/admin')->group(function (){
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

        Route::get('/axios/permissions/{id}','Admin\AxiosController@permissions');
        Route::get('/axios/roles','Admin\AxiosController@roles');
        Route::post('/axios/role/search','Admin\AxiosController@searchRole');
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
        Route::post('/axios/author/get','Admin\AxiosController@getAuthor');
        Route::get('/axios/genres-notin/{id}','Admin\AxiosController@genresNotIn');
        Route::get('/axios/teams-notin/{id}','Admin\AxiosController@teamsNotIn');
        Route::post('/axios/search-genres','Admin\AxiosController@searchGenre');
        Route::post('/axios/search-permission','Admin\AxiosController@searchPermission');
        Route::post('/axios/chap-image-edit','Admin\AxiosController@chapImageEdit');
        Route::get('/axios/users','Admin\AxiosController@users');
        Route::post('/axios/search-teams','Admin\AxiosController@searchTeams');
        Route::get('/axios/translate-teams','Admin\AxiosController@teams');
        Route::post('/axios/search-author','Admin\AxiosController@searchAuthor');
        Route::post('/axios/all-contacts','Admin\AxiosController@getAllContacts');
        Route::post('/axios/get-conversation','Admin\AxiosController@getConversation');
        Route::post('/axios/get-admins','Admin\AxiosController@getAdmins');
        Route::get('/axios/get-roles','Admin\AxiosController@getRoles');
        Route::post('/axios/search-admin','Admin\AxiosController@searchAdmin');
        Route::post('/axios/admin/check-email','Admin\AxiosController@checkEmailAdmin');
        Route::post('/axios/admin/check-permission','Admin\AxiosController@checkPer');
    });
});