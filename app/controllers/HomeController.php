<?php

use NpmWeb\MiddlewareClient\Chms\PeopleClient;

class HomeController extends BaseController {

	protected $people;

	public function __construct( PeopleClient $people ) {
		$this->people = $people;
	}

	public function showWelcome()
	{
		// var_dump($this->people);exit;
		echo '<b>Environment</b>: '.App::environment().'<br />';
		echo '<b>myconfig.string</b>: '.Config::get('myconfig.string').'<br />';
		echo '<b>myconfig.inherited</b>: '.Config::get('myconfig.inherited').'<br />';
		echo '<b>myconfig.array</b>: '.print_r(Config::get('myconfig.array'),true).'<br />';
		echo '<b>reference marital-statuses</b>: ';
		var_dump(Reference::get('marital-statuses'));
		echo '<br /><b>middleware</b>: ';
		var_dump($this->people->getPerson(16029));
	}

}