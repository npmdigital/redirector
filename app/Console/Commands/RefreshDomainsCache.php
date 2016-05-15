<?php namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Domain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshDomainsCache extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'redirector:refresh-domains-cache';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshes the cached list of domains used on the domains index page.';

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
        Cache::forget('domains');

        Cache::remember('domains', Carbon::now()->addMinutes(10), function()
        {
            return Domain::domainsWithHits()->get();
        });
	}

}
