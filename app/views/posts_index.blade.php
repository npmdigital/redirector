@extends('layout')

@section('content')
	hi!

	Login: {{ $loginSuccess ? 'success' : 'fail' }}
@stop
