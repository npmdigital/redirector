<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Route::get('login',function() {
 	return View::make('login');
});
Route::get('logout',function() {
	Auth::logout();
	return Redirect::to('/');
});
Route::post('authenticate',function() {
	$credentials = Input::only('username', 'password'); 
	if (Auth::attempt($credentials)) {
		return Redirect::intended('/');
	}
	return Redirect::to('login');
});

Route::get('users', array(
	'before' => 'auth',
	'uses' => 'NPM\UserController@index'
));

Route::get('users/{id}', 'NPM\UserController@showProfile');

Route::get('security', 'NPM\SecurityController@index');
Route::get('security/xss', 'NPM\SecurityController@xss');
Route::get('security/sqli', 'NPM\SecurityController@sqli');
Route::get('security/csrf', 'NPM\SecurityController@csrf_get');
Route::post('security/csrf', array(
	'before'=>'csrf',
	'uses' => 'NPM\SecurityController@csrf_post',
	'as' => 'security.csrf'
));

Route::resource('posts', 'PostsController');
Route::resource('registrations', 'UnitTestExample\RegistrationsController');
Route::post('registrations/update-status', 'UnitTestExample\RegistrationsController@updateStatus');
