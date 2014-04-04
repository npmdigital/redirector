<?php

namespace NPM;

class SecurityController extends \BaseController {

	public function index() {
		return \View::make('security.index');
	}

	public function xss() {
		return \View::make('security.xss')->with('insecureText','<script>alert("Hi")</script>');
	}

	public function sqli() {
		return \View::make('security.sqli');
	}

	public function csrf_get() {
		return \View::make('security.csrf');
	}

	public function csrf_post() {
		echo 'Submission accepted!';
	}

}
