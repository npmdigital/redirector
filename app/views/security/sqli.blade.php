@extends('layout')

@section('content')
	
	{{ link_to('security', 'back') }}

	<h2>SQL Injection</h2>

	<h3>Secure: So Many Things</h3>

	<pre>
$results = Users::all();
// or
$results = DB::table('users')->where('name',$var)->get();
// or even!
$results = DB::select('select * from users where name = ?', array($var));
	</pre>

	<h3>Insecure: Just This One Dumb Unnecessary Thing</h3>

	<pre>$results = DB::select('select * from users where name = "' . $var . '"' );</pre>

	Don't do it! Just don't! Even if it's a variable from a config file!

@stop
