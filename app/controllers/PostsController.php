<?php

use NpmWeb\Login\LoginInterface as Login;

class PostsController extends \BaseController {

	protected $post;
	protected $login;

	public function __construct(Post $post, Login $login)
	{
		$this->post = $post;
		$this->login = $login;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = $this->post->all();
		$loginSuccess = $this->login->login('user','pass');
		return View::make('posts_index', array(
			'posts' => $posts,
			'loginSuccess' => $loginSuccess,
		));;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $input = Input::all();
	 
	    // We'll run validation in the controller for convenience
	    // You should export this to the model, or a service
	    $v = Validator::make($input, array('title' => 'required'));
	 
	    if ($v->fails())
	    {
	        return Redirect::route('posts.create')
	            ->withInput()
	            ->withErrors($v->messages());
	    }
	 
	    $this->post->create($input);
	 
	    return Redirect::route('posts.index')
	        ->with('flash', 'Your post has been created!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}