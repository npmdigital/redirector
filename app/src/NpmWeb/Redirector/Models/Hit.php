<?php

namespace NpmWeb\Redirector\Models;

use \LaravelBook\Ardent\Ardent;

class Hit extends Ardent {

	public static $rules = [
		'domain_id' => ['required'],
		'server_values' => ['required'],
	];

	public $fillable = [
		'domain_id', 'server_values'
	];

}
