<?php

//Auth::routes();

Route::get('admin/dashboard', 'HomeController@index')->name('home');

Route::post('admin/auth/login', 'Auth\LoginController@authenticate')->name('auth.login');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('auth/register', 'Auth\RegisterController@register')->name('auth.register');

Route::post('user/{user}/register', 'Auth\RegisterController@register')->name('user.delete');

Route::get('admin/auth/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', function (){

    return redirect()->route('login');
});
//
Route::fallback(function(){

    return redirect()->route('home')->with('info', 'Sorry about that, this route is undefined');
});
