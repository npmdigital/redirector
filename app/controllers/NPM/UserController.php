<?php

namespace NPM;

class UserController extends \BaseController {
	
	public function __construct(\User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->all();
		return \View::make('users')->with('users',$users);
	}

	public function showProfile($id)
	{
		$user = $this->user->find($id);
		return \View::make('userprofile', array('user'=>$user));
	}

}
