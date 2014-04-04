<?php

use \NpmWeb\Redirector\Models\Hit;

class HitSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('hits')->delete();
	}

}
