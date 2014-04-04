<?php

namespace UnitTestExample;

use \Input;
use \Log;
use \Redirect;
use \UnitTestExample\Registration;
use \Validator;
use \View;

class RegistrationsController extends \BaseController {

	protected $reg;
	// protected $validator;

	public function __construct(Registration $reg)
	{
		$this->reg = $reg;
		// $this->validationRules = array('name' => 'required');
	}

	public function updateStatus() {
	    $input = Input::all();
		$this->reg->updateStatus($input['new_status']);
	    // return Redirect::route('registrations.index')
	    // 	->with('flash', 'Your status has been updated!');
	    return View::make('registrations.statusUpdated')
	   		->with('message', 'Your status has been updated!');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		Log::info('testing the log');
		$regs = $this->reg->all();
		return View::make('registrations.index')->with('registrations',$regs);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('registrations.edit')->with('registration',$this->reg);
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
	    // $v = Validator::make($input, $this->validationRules);
	 
	    // if (!$v->fails())
	    $this->reg->fill($input);
	    if( !$this->reg->save() )
	    {
	        return Redirect::route('registrations.create')
	            ->withInput()
	            ->withErrors($this->reg->errors());
	    }
	 
	    // $this->reg->create($input);
	 
	    return Redirect::route('registrations.index')
	        ->with('myflash', 'Your registration has been created!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$reg = $this->reg->findOrFail($id);
		return View::make('registrations.show')->with('registration',$reg);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reg = $this->reg->findOrFail($id);
		return View::make('registrations.edit')->with('registration',$reg);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$reg = $this->reg->findOrFail($id);

	    $input = Input::all();
	 
	    // We'll run validation in the controller for convenience
	    // You should export this to the model, or a service
	    // $v = Validator::make($input, $this->validationRules);
	 
	    // if ($v->fails())
	    $this->reg->fill($input);
	    if( !$this->reg->save() )
	    {
	        return Redirect::route('registrations.edit',$id)
	            ->withInput()
	            ->withErrors($this->reg->errors());
	    }
	 
	 	// $reg->name = $input['name'];
	  //   $reg->save();
	 
	    return Redirect::route('registrations.show', $id)
	        ->with('myflash', 'Your registration has been updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$reg = $this->reg->findOrFail($id);
		$reg->delete();
	    return Redirect::route('registrations.index')
	        ->with('myflash', 'Your registration has been deleted!');
	}

}
