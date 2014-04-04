<?php

class UserTest extends TestCase {

	public function __construct()
	{
		$this->mock = Mockery::mock('Eloquent', 'User');
	}

	public function testUsers()
	{
		$this->mock
			->shouldReceive('all')
			->once()
			->andReturn(array(
				(object)array('name'=>'Foo Bar'),
				(object)array('name'=>'Baz Qux')
			));

		$this->app->instance('User', $this->mock);

		$response = $this->call('GET', 'users');
		$content = $response->getContent();
		$this->assertResponseOk();
		$this->assertViewHas('users');
		$this->assertContains('Foo Bar',$content);
		$this->assertContains('Baz Qux',$content);
	}

	public function testUserProfile()
	{
		$this->mock
			->shouldReceive('find')
			->once()
			->andReturn((object)array('name'=>'Foo Bar'));

		$this->app->instance('User', $this->mock);

		$response = $this->action('GET', 'NPM\UserController@showProfile', array('id'=>1));
		$content = $response->getContent();
		$this->assertResponseOk();
		$this->assertViewHas('user');
		$this->assertContains('Foo Bar',$content);
	}

}