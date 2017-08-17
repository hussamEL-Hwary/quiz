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
    return view('pages.contactus');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('teacher')->group(function(){
  Route::get('/login','Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
  Route::post('/login','Auth\TeacherLoginController@login')->name('teacher.login.submit');
  Route::get('/','TeacherController@index')->name('teacher.dashboard');
  Route::get('/logout','Auth\TeacherLoginController@logout')->name('teacher.logout');
});
