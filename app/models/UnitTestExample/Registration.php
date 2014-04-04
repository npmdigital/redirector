<?php

namespace UnitTestExample;

use \LaravelBook\Ardent\Ardent;
use \Mail;

class Registration extends Ardent {

	public static $rules = array(
		'name' => array('required','max:20'),
	);

	protected $fillable = array('name');

	const STATUS_CANCELLED = 9;

	public function updateStatus( $newStatus ) {

		$this->status = $newStatus;
		$this->save();
		Mail::send('emails.cancelled', array(), null);
		return true;
	}

}
