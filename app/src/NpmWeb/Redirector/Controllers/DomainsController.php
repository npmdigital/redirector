<?php

namespace NpmWeb\Redirector\Controllers;

use \NpmWeb\Redirector\Models\Domain;
use \Redirect;

class DomainsController extends BaseController {

	public function index() {
		$domain = Domain::where('name','=',$_SERVER['SERVER_NAME'])
			->first();
		return Redirect::to(
			$domain->redirect_url,
			$domain->status
		);
	}

}
