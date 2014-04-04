<?php

namespace NpmWeb\Redirector\Controllers;

use \NpmWeb\Redirector\Models\Domain;
use \NpmWeb\Redirector\Models\Hit;
use \Redirect;

class DomainsController extends BaseController {

	public function index() {
		// get domain
		$domain = Domain::where('name','=',$_SERVER['SERVER_NAME'])
			->first();

		// log hit
		$hit = new Hit();
		$hit->fill([
			'domain_id' => $domain->id,
			'server_values' => json_encode($_SERVER)
		]);
		$hit->save();

		// redirect to destination
		return Redirect::to(
			$domain->redirect_url,
			$domain->status
		);
	}

}
