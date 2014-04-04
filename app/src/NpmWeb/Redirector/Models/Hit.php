<?php

namespace NpmWeb\Redirector\Models;

use \LaravelBook\Ardent\Ardent;

class Hit extends Ardent {

	public static $rules = array(
		'domain_id' => array('required'),
		'server_values' => array('required'),
	);

	public $fillable = array(
		'domain_id', 'server_values'
	);

}
