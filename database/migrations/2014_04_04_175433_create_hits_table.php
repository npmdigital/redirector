<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hits', function($table)
		{
			$table->increments('id');
		    $table->timestamps();

		    $table->integer('domain_id')->unsigned();
		    $table->foreign('domain_id')
		    	->references('id')->on('domains');

		    $table->text('server_values');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('domains');
	}

}
