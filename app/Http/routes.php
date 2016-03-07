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

App::missing(function ($e) {
    return '404 Not found';
});

Route::group(['prefix' => 'admin', 'namespace' => 'NpmWeb\Redirector\Controllers\Admin'], function () {
    Route::get('/', ['as' => 'login'], function () {
        return 'admin';
    });

    Route::resource('domains', 'DomainsController');
});

Route::any('{all}', 'NpmWeb\Redirector\Controllers\DomainsController@index')
    ->where('all', '.*');
