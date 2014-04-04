<?php

namespace UnitTestExample;

use \Mail;
use \Mockery;
// use "composer dump-autoload" for models in subdirs to be recognized

/**
 * Model test goals: for each custom thick-model method, test each
 * different situation of data coming in (no data, invalid, valid,
 * etc.) Use mocks to make sure each collaborator is called correctly.
 * Test the returned data: is it correct? Was the correct exception
 * thrown?
 */
class RegistrationModelTest extends \TestCase {

	public function setUp()
	{
		parent::setUp();

		// We want to use the real model, and Ardent's validation, but
		// mock out Eloquent's DB access methods. So only mock out the
		// save method.
		$this->reg = Mockery::mock('UnitTestExample\Registration[save]')->makePartial();
	}

	public function testValidationFail()
	{
		// arrange
		$input = array();

		// act
		$this->reg->fill($input);
		$result = $this->reg->validate();

		// assert: got correct errors
		$this->assertFalse($result);
		$this->assertContains('The name field is required.',$this->reg->errors()->get('name'));
	}

	public function testValidationSuccess()
	{
		// arrange
		$input = array('name'=>'foo');

		// act
		$this->reg->fill($input);
		$result = $this->reg->validate();

		// assert: got correct errors
		$this->assertTrue($result);
	}

	public function testModelUpdateStatus()
	{
		// arrange: mock ORM and Mail calls
			// model should be saved
		// $this->reg->shouldReceive('save')->once();
			// "cancelled" email should be sent
		Mail::shouldReceive('send')
			->once()
			->with('emails.cancelled', array(), null);

		// act: update the status
		$result = $this->reg->updateStatus(Registration::STATUS_CANCELLED);

		// assert: return value and updated model field
			// should return successfully
		$this->assertTrue($result);
			// status should be updated to cancelled
		$this->assertEquals( Registration::STATUS_CANCELLED, $this->reg->status );
	}

}
