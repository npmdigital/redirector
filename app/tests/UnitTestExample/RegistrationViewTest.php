<?php

namespace UnitTestExample;

use Mockery;
use Symfony\Component\DomCrawler\Crawler;
use View;

/**
 * View test goals: for each view file, test each different situation of
 * data passed to it (new record, existing, etc.) Is the correct data
 * outputted into the HTML?
 */
class RegistrationViewTest extends \TestCase {
	
	public function setUp()
	{
		parent::setUp();

		// We want to use the real controller but mock out the model,
		// so we create a full mock model and pass it into the IoC
		// container.
		$this->reg = Mockery::mock('UnitTestExample\Registration');
		$this->app->instance('UnitTestExample\Registration',$this->reg);
	}

	public function testIndexView()
	{
		// arrange
		$regs = array(
			(object)array('id'=>1,'name'=>'Foo'),
			(object)array('id'=>2,'name'=>'Bar'),
		);

		// act
	    $crawler = $this->crawl(View::make('registrations.index')
	   							->with('registrations', $regs));
	   	
	   	// assert
	   	foreach( $regs as $reg ) {
		   	$this->assertCount( 1, $crawler->filter('td.id:contains("'.$reg->id.'")'));
		   	$this->assertCount( 1, $crawler->filter('td.name:contains("'.$reg->name.'")'));
	   	}
	}

	public function testShowView()
	{
		// arrange
		$reg = (object)array('id'=>1,'name'=>'Foo');

		// act
	    $crawler = $this->crawl(View::make('registrations.show')
	   							->with('registration', $reg));
	   	
	   	// assert
	   	$this->assertCount( 1, $crawler->filter('td.id:contains("'.$reg->id.'")'));
	   	$this->assertCount( 1, $crawler->filter('td.name:contains("'.$reg->name.'")'));
	}

	public function testEditViewCreate()
	{
		// arrange
		$reg = (object)array('id'=>null,'name'=>null);

		// act
	    $crawler = $this->crawl(View::make('registrations.edit')
	   							->with('registration', $reg));
	   	
	   	// assert
	   	$this->assertCount( 1, $crawler->filterXPath('//input[@name="name"][not(@value)]'));
	}

	public function testEditViewEdit()
	{
		// arrange
		$reg = (object)array('id'=>1,'name'=>'Foo');

		// act
	    $crawler = $this->crawl(View::make('registrations.edit')
	   							->with('registration', $reg));
	   	
	   	// assert
	   	$this->assertCount( 1, $crawler->filterXPath('//input[@name="name"][@value="'.$reg->name.'"]'));
	}

}
