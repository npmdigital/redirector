@extends('layout')

@section('content')

	{{ link_to('security', 'back') }}

	<h2>Cross-Site Request Forgery</h2>

	<h3>Secure: CSRF Token via Form Submit</h3>

	{{ Form::open(array('route'=>'security.csrf')) }}
		{{ Form::submit('Submit') }}
	{{ Form::close() }}

	<h3>Insecure: No CSRF Token via Ajax</h3>

	<input type="button" value="Submit" id="no-csrf-button" />

	<h3>Secure: CSRF Token via Ajax</h3>

	<input type="button" value="Submit" id="csrf-button" />

@stop

@section('js')
	<script type="text/javascript">
		var baseUrl = {{ esc_js(url('/')) }};
		var csrfToken = {{ esc_js(csrf_token()) }};

		var successHandler = function(response) {
			console.log(response);
			alert('Success: '+response);
		};

		var errorHandler = function(xhr) {
			console.log(xhr);
			alert('Error: '+xhr.responseText);
		};

		$(function(){
			$('#no-csrf-button').click(function(){
				$.ajax({
					url: baseUrl+'/security/csrf',
					type: 'POST',
					data: { 'foo': 'baseUrl' },
					dataType: 'text',
					success: successHandler,
					error: errorHandler
				}); // ajax()
			}); // click()

			$('#csrf-button').click(function(){
				$.ajax({
					url: baseUrl+'/security/csrf',
					type: 'POST',
					data: { '_token': csrfToken, 'foo': 'baseUrl' },
					dataType: 'text',
					success: successHandler,
					error: errorHandler
				}); // ajax
			}); // click

		}); // $()
	</script>
@stop
