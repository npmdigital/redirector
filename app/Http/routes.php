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

Route::get('auth/login', function() {
    if (Auth::check()) redirect('admin/domains');
    return \View::make('auth.login');
});

Route::post('auth/login', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@authenticate',
]);

Route::get('auth/logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@logout',
]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('domains', 'DomainsController');
});

Route::group(['prefix' => '_debugbar', 'namespace' => 'Barryvdh\Debugbar\Controllers'], function() {
    Route::get('open', [
        'as' => 'debugbar.openhandler',
        'uses' => 'OpenHandlerController@handle',
    ]);
    Route::get('assets/stylesheets', [
        'as' => 'debugbar.assets.css',
        'uses' => 'AssetController@css',
    ]);
    Route::get('assets/javascript', [
        'as' => 'debugbar.assets.js',
        'uses' => 'AssetController@js',
    ]);
});

Route::any('{all}', 'DomainsController@index')
    ->where('all', '.*');
