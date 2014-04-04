<?php

namespace NpmWeb\Redirector\Models;

use \LaravelBook\Ardent\Ardent;

class Domain extends Ardent {

	public static $rules = array(
		'name' => array('required','max:100'),
		'redirect_url' => array('required','max:300'),
		'status' => array('required','integer','in:301,302'),
	);

}
