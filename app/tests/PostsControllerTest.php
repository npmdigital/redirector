<?php

class PostsControllerTest extends TestCase {

	public function __construct()
	{
		$this->mock = Mockery::mock('Eloquent', 'Post');
	}

	public function tearDown()
	{
		Mockery::close();
	}

	public function testIndex()
	{
		$this->mock
			->shouldReceive('all')
			->once()
			->andReturn('foo');

		$this->app->instance('Post', $this->mock);

		$response = $this->call('GET','posts');

		$this->assertViewHas('posts');

		$data = $response->original->getData();
		$posts = $data['posts'];
		$this->assertEquals('foo', $posts);
	}

	public function testStoreFailure()
	{
		$input = array('title' => '');

		$this->app->instance('Post', $this->mock);

		$this->client->request('POST', 'posts', $input);

		$this->assertRedirectedToRoute('posts.create');
		$this->assertSessionHasErrors(array('title'));
	}

	public function testStoreSuccess()
	{
		$input = array('title' => 'My Title');

		$this->mock
			->shouldReceive('create')
			->once()
			->with($input);

		$this->app->instance('Post', $this->mock);

		$this->client->request('POST', 'posts', $input);

		$this->assertRedirectedToRoute('posts.index');
	}

}