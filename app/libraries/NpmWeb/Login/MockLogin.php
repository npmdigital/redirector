<?php

namespace NpmWeb\Login;

class MockLogin implements LoginInterface {
	public function login( $username, $password ) {
		return true; // success
	}
}
