<?php

use \NpmWeb\Redirector\Models\Domain;

class DomainSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->delete();

        $domain = new Domain();
        $domain->fill([
            'name' => 'local.redirect.npmweb.org',
            'redirect_url' => 'http://npmweb.org',
            'status' => 302,
        ]);
        $domain->save();

        $domain = new Domain();
        $domain->fill([
            'name' => 'local.inactive.npmweb.org',
            'redirect_url' => 'http://npmweb.org',
            'status' => 302,
            'active' => false,
        ]);
        $domain->save();
    }

}
