@extends('layout')

@section('content')
	{!! Form::open(array('url' => 'authenticate','method' => 'post', 'id' => 'login_form')) !!}
    	<p>{!! Form::label('username', 'User Name:') !!}</p>
    	<p>{!! Form::text('username', '', array('id' => 'username')) !!}</p>
    	<p>{!! Form::label('password', 'Password:') !!}</p>
    	<p>{!! Form::password('password', array('id' => 'password')) !!}</p>
    	<p>{!! Form::submit('Logon') !!}</p>
	{!! Form::close() !!}
@stop