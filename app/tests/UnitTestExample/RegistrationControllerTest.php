<?php

namespace UnitTestExample;

use Mockery;

/**
 * Controller test goals: for each action, test each different situation
 * of data coming in (no data, invalid, valid, etc.). Use mocks to make
 * sure each collaborator is called correctly. Test the response: was the
 * correct exception thrown? Was the right status returned? Was the right
 * view called, and the right data passed to it?
 */
class RegistrationControllerTest extends \TestCase {
	
	public function setUp()
	{
		parent::setUp();

		// We want to use the real controller but mock out the model,
		// so we create a full mock model and pass it into the IoC
		// container.
		$this->reg = Mockery::mock('UnitTestExample\Registration');
		$this->app->instance('UnitTestExample\Registration',$this->reg);
	}

	public function testControllerUpdateStatus() {
		// arrange: mock Registration model calls
		$newStatus = 27;
		$this->reg
			->shouldReceive('updateStatus')
			->with($newStatus)
			->andReturn('true');

		// act: make controller call
		$this->call('POST', 'registrations/update-status',
			array('new_status' => $newStatus));

		// assert: message shown
		$this->assertViewHas('message');
	}

	public function testIndex() {
		// arrange
		$regs = array(	(object)array('id'=>1,'name'=>'Foo'),
						(object)array('id'=>2,'name'=>'Bar'));
		$this->reg
			->shouldReceive('all')
			->andReturn($regs);

		// act
		$this->call('GET', 'registrations');

		// assert: has data
		$this->assertResponseOk();
		$this->assertViewHas('registrations',$regs);
	}

	public function testCreate() {
		// arrange
		$this->reg
			->shouldReceive('getAttribute')
			->andReturn(null);
		$this->reg
			->shouldReceive('hasGetMutator')
			->andReturn(false);

		// act
		$this->call('GET', 'registrations/create');

		// assert: did not error out
		$this->assertResponseOk();
		$this->assertViewHas('registration',$this->reg);
	}

	// you would have multiple tests for multiple bad data scenarios
	// (unless the validator was moved into the model)
	public function testStoreError() {
		// arrange
		$input = array();
		$this->reg
			->shouldReceive('fill')
			->with($input);
		$this->reg
			->shouldReceive('save')
			->andReturn(false);
		$this->reg
			->shouldReceive('errors')
			->andReturn(array('name'=>'name is required'));

		// act
		$this->call('POST', 'registrations', $input);

		// assert: errored out
		$this->assertRedirectedToRoute('registrations.create');
		$this->assertSessionHasErrors(array('name'));
	}

	public function testStoreSuccess() {
		// arrange
		$input = array('name'=>'Foo');
		$this->reg
			->shouldReceive('fill')
			->with($input);
		$this->reg
			->shouldReceive('save')
			->andReturn(true);

		// act
		$response = $this->call('POST', 'registrations', $input);

		// assert: success redirect
		$this->assertRedirectedToRoute('registrations.index');
		$this->assertSessionHas('myflash','Your registration has been created!');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function testShowError() {
		// arrange
		$id = 27;
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

		// act
		$this->call('GET', 'registrations/'.$id);

		// assert: exception thrown
	}

	public function testShowSuccess() {
		// arrange
		$id = 27;
		$obj = (object)array('id'=>$id,'name'=>'Foo');
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andReturn($obj);

		// act
		$this->call('GET', 'registrations/'.$id);

		// assert: errored out
		$this->assertResponseOk();
		$this->assertViewHas('registration',$obj);
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function testEditError() {
		// arrange
		$id = 27;
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

		// act
		$this->call('GET', 'registrations/'.$id.'/edit');

		// assert: exception thrown
	}

	public function testEditSuccess() {
		// arrange
		$id = 27;
		$obj = (object)array('id'=>$id,'name'=>'Foo');
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andReturn($obj);

		// act
		$this->call('GET', 'registrations/'.$id.'/edit');

		// assert: succeeded
		$this->assertResponseOk();
		$this->assertViewHas('registration',$obj);
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function testUpdateNotFoundError() {
		// arrange
		$id = 27;
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

		// act
		$this->call('PUT', 'registrations/'.$id);

		// assert: exception thrown
	}

	// you would have multiple tests for multiple bad data scenarios
	// (unless the validator was moved into the model)
	public function testUpdateValidationError() {
		// arrange
		$id = 27;
		$input = array();
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andReturn(\Mockery::self());
		$this->reg
			->shouldReceive('fill')
			->with($input);
		$this->reg
			->shouldReceive('save')
			->andReturn(false);
		$this->reg
			->shouldReceive('errors')
			->andReturn(array('name'=>'name is required'));

		// act
		$this->call('PUT', 'registrations/'.$id, $input);

		// assert: errored out
		$this->assertRedirectedToRoute('registrations.edit',$id);
		$this->assertSessionHasErrors(array('name'));
	}

	public function testUpdateSuccess() {
		// arrange
		$id = 27;
		$input = array('name'=>'Foo');
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andReturn(\Mockery::self());
		$this->reg
			->shouldReceive('fill')
			->with($input);
		$this->reg
			->shouldReceive('save')
			->andReturn(true);

		// act
		$this->call('PUT', 'registrations/'.$id, $input);

		// assert: success redirect
		$this->assertRedirectedToRoute('registrations.show',$id);
		$this->assertSessionHas('myflash','Your registration has been updated!');
	}

	/**
	 * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function testDestroyError() {
		// arrange
		$id = 27;
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException);

		// act
		$this->call('DELETE', 'registrations/'.$id);

		// assert: exception thrown
	}

	public function testDestroySuccess() {
		// arrange
		$id = 27;
		$this->reg
			->shouldReceive('findOrFail')
			->with($id)
			->andReturn(\Mockery::self());
		$this->reg
			->shouldReceive('delete');

		// act
		$this->call('DELETE', 'registrations/'.$id);

		// assert: succeeded
		$this->assertRedirectedToRoute('registrations.index');
		$this->assertSessionHas('myflash','Your registration has been deleted!');
	}

}
