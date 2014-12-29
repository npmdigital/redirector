<?php

namespace NpmWeb\Redirector\Controllers;

use \App;
use \NpmWeb\Redirector\Models\Domain;
use \NpmWeb\Redirector\Models\Hit;
use \Redirect;

class DomainsController extends BaseController {

    public function index() {
        $domain = Domain::matching($_SERVER['SERVER_NAME'])
            ->first();
        if( !$domain || !$domain->active ) {
            App::abort(404);
        }

        // log hit
        $data = array(
            'domain_id' => $domain->id,
            'server_values' => json_encode($_SERVER)
        );
        if( isset($_SERVER['HTTP_REFERER']) ) {
            $data['referer'] = $_SERVER['HTTP_REFERER'];
        }
        Hit::create($data);

        // redirect to destination
        return Redirect::to(
            $domain->redirect_url,
            $domain->status
        );
    }

}
