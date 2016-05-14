<?php namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PurgeYearOldHits extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'redirector:purge-year-old-hits';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Daily purges hits that are more than a year old.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		DB::table('hits')->where('created_at', '<=', Carbon::now()->subYear())->delete();
	}
}
