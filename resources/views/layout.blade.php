<html>
	<head>
		<title>Laravel Template</title>

		<script src="{!! asset('components/jquery/jquery.min.js') !!}"></script>
		<script src="{!! asset('components/underscore/underscore-min.js') !!}"></script>
		<script src="{!! asset('includes/js/jquery-validation/jquery.validate.min.js') !!}"></script>
		@yield('js')
	</head>
	<body>
		<h1>Laravel Template</h1>

		@yield('content')
	</body>
</html>
