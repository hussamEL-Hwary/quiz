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
    return view('pages.teacher.teacherprofile');
});
Auth::routes();
//Auth::routes();
Route::get('/register','Auth\GeneralRegisterController@showRegiterForm')->name('register');
Route::post('/register','Auth\GeneralRegisterController@call')->name('register.submit');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('login/social/{provider}/{type}','Auth\SocialController@redirectToProvider')->where(['provider' => 'facebook|google|twitter|github|instagram'],['type'=> 'teacher|student'])->name('social.login');
Route::get('login/{provider}/check/','Auth\SocialController@handleProviderCallback')->name('social.callback');

Route::prefix('teacher')->group(function(){
  Route::get('/login','Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
  Route::post('/login','Auth\TeacherLoginController@login')->name('teacher.login.submit');
  Route::get('/','TeacherController@index')->name('teacher.dashboard');
  Route::get('/logout','Auth\TeacherLoginController@logout')->name('teacher.logout');
  Route::get('/createcategory','CategoryController@index')->name('create.category');
  Route::post('/createcategory','CategoryController@store')->name('category.submit');

  //reset Password routes
  Route::post('/password/email','Auth\TeacherForgotPasswordController@sendResetLinkEmail')->name('teacher.password.email');
  Route::post('/password/reset','Auth\TeacherResetPasswordController@reset');
  Route::get('/password/reset','Auth\TeacherForgotPasswordController@showLinkRequestForm')->name('teacher.password.request');
  Route::get('/password/reset/{token}','Auth\TeacherResetPasswordController@showResetForm')->name('teacher.password.reset');

  //profile
  Route::get('/profile/{id}','TeacherProfileController@show');
  Route::get('/setting','TeacherProfileController@showEdit');
  Route::post('/setting','TeacherProfileController@updateProfile');
  Route::post('/account','TeacherProfileController@updateAccount');
});

Route::prefix('student')->group(function(){
  Route::get('/login','Auth\StudentLoginController@showLoginForm')->name('student.login');
  Route::post('/login','Auth\StudentLoginController@login')->name('student.login.submit');
  Route::get('/','StudentController@index')->name('student.dashboard');
  Route::get('/logout','Auth\StudentLoginController@logout');

  //reset Password routes
  Route::post('/password/email','Auth\StudentForgotPasswordController@sendResetLinkEmail')->name('student.password.email');
  Route::post('/password/reset','Auth\StudentResetPasswordController@reset');
  Route::get('/password/reset','Auth\StudentForgotPasswordController@showLinkRequestForm')->name('student.password.request');
  Route::get('/password/reset/{token}','Auth\StudentResetPasswordController@showResetForm')->name('student.password.reset');

});
