<?php

namespace NpmWeb\Login;

use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider {
	public function register()
	{
		$this->app->bind('NpmWeb\Login\LoginInterface', 'NpmWeb\Login\MockLogin');
	}
}
