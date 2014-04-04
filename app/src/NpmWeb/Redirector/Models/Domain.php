<?php

namespace NpmWeb\Redirector\Models;

use \LaravelBook\Ardent\Ardent;

class Domain extends Ardent {

	public static $rules = [
		'name' => ['required','max:100'],
		'redirect_url' => ['required','max:300'],
		'status' => ['required','integer','in:301,302'],
	];

}
