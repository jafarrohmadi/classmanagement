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
$this->get('/', 'Auth\LoginController@showLoginForm')->name('login');

//otp
Route::get('verify-otp', 'Auth\\LoginController@showCodeForm');
Route::post('verify-otp', 'Auth\\LoginController@storeCodeForm')->name('verify-otp');

Auth::routes();

Route::group(['prefix' => 'user','middleware' => 'auth'], function () {
	//Home
	Route::get('/', 'User\\HomeController@index');
	Route::get('searchclass', 'User\\HomeController@getClass');
	Route::get('/generate-pdf','User\\HomeController@generatePDF');
	//students
	Route::get('students/data', 'User\\StudentsController@data')->name('user.students.data');
	Route::resource('students', 'User\\StudentsController');
	//teacher
	Route::get('teacher/data', 'User\\TeacherController@data')->name('user.teacher.data');
	Route::resource('teacher', 'User\\TeacherController');
	//class
	Route::get('searchstudent', 'User\\ClassController@getStudent');
	Route::get('searchteacher', 'User\\ClassController@getTeacher');
	Route::get('class/data', 'User\\ClassController@data')->name('user.class.data');
	Route::resource('class', 'User\\ClassController');

	//profile
	Route::get('profile', 'User\\ProfileController@index');
	Route::patch('profile/{user}',  'User\\ProfileController@updateProfile');
	Route::get('change-password', 'User\\ProfileController@changePassword');
	Route::post('store-password', 'User\\ProfileController@storePassword')->name('user.store.password');
});

