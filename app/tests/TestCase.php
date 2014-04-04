<?php

use Symfony\Component\DomCrawler\Crawler;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		ini_set('memory_limit','256M');

		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	protected function crawl($view)
	{
		return new Crawler($view->render());
	}

}
