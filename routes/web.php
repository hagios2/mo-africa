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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');

Route::post('auth/login', 'CustomLoginController@authLogin')->name('auth.login');

Route::get('login', 'CustomLoginController@showLoginForm')->name('login');

Route::get('returns', 'UploadsController@getFileList')->name('get.files');

Route::post('file/submit', 'UploadsController@submitFile')->name('file.submit');

Route::get('file/submit', 'UploadsController@getFileList');

Route::get('logout', 'CustomLoginController@authLogout')->name('logout');

Route::get('/', function (){

    return redirect()->route('login');
});

Route::fallback(function(){

    return redirect()->route('home')->with('info', 'Sorry about that, this route is undefined');
});
