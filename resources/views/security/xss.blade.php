@extends('layout')

@section('content')

	{!! link_to('security', 'back') !!}

	<h2>Cross-Site Scripting</h2>

	<p>Every time you output a user-provided variable onto a page, there
	is a security risk. And there is not one method that secures every
	situation. We've created a library of enc_() methods for different
	situations, illustrated below.</p>

	<p>For each method, we include sample code demonstrating the
	protection. For each, code outputs "Attemtiong to hack...", then
	attempts to inject JS to write to console.log().
	Check the console and you should see a number of "this should not
	be stopped" messages. But you should not see any "this should be
	stopped" messages.</p>

	<h3>Body</h3>

	<pre>&lt;p&gt;@{{enc_body($var)}}&lt;/p&gt;</pre>

	<h4>Examples (view source)</h4>

	<p>{!! "Attempting to hack...<script>console.log('Body: this should not be stopped.')</script>" !!}</p>
	<p>{!! esc_body("Attempting to hack...<script>console.log('Body: this should be stopped.')</script>") !!}</p>

	<h3>Attribute</h3>

	<pre>&lt;img src="..." title="@{{enc_attr($var)}}" /&gt;</pre>

	<p>Always use quotes around your attributes, or else this isn't secure!</p>

	<h4>Examples (view source)</h4>

	<p><a href="#" title="{!! 'Attempting to hack..." onmouseover="console.log(\'Attribute: this should not be stopped.\')"' !!}">Mouse Over Me</a></p>
	<p><a href="#" title="{!! esc_attr('Attempting to hack..." onmouseover="console.log(\'Attribute: this should be stopped.\')"') !!}">Mouse Over Me</a></p>

	<h3>URL</h3>

	<pre>http://foo.com/search?query=@{{esc_url($var)}}</pre>

	<p><a href="?param={!! 'Attempting to hack..." onmouseover="console.log(\'URL: this should not be stopped.\')"' !!}">Mouse Over Me</a></p>
	<p><a href="?param={!! esc_url('Attempting to hack..." onmouseover="console.log(\'URL: this should be stopped.\')"') !!}">Mouse Over Me</a></p>

	<h3>JavaScript</h3>

	<pre>var myvar = @{{esc_js($var)}};</pre>

	<p>This is for individual values only, not for arrays or objects! For those, use the JSON encoding.

	<h4>Examples (view source)</h4>

	<script>
		var myvar1 = "{!! 'Attempting to hack..."; console.log(\'JavaScript: this should not be stopped.\'); "' !!}";
		document.write('<p>'+myvar1+'</p>');
		var myvar2 = {!! esc_js('Attempting to hack..."; console.log(\'JavaScript: this should be stopped.\'); "') !!};
		document.write('<p>'+myvar2+'</p>');
	</script>

	<h3>JSON</h3>

	<p>This one is a bit complex. The standard method of putting JSON into your page is insecure:</p>

	<pre>var myobj = @{{json_encode($myobj)}}; // NO BAD WRONG</pre>

	<p>
		Instead, JSON should be put in its own &lt;script&gt; tag of
		type "application/json", and HTML-escaped. From there, it can
		be read into JavaScript from the DOM.
	</p>

	<p>
		Note: this requires jQuery and underscore.js
	</p>

	<pre>
@{{ esc_json($myobj, 'myid' ) }}
&lt;script type="application/javascript"&gt;
	var jsonTextEncoded = $('#myid').html();
	var jsonObj = JSON.parse(_.unescape(jsonTextEncoded));
&lt;/script&gt;
	</pre>

	<h4>Examples (view source)</h4>
	
	<script type="application/javascript">
		var myvar3 = {!! json_encode(array('foo'=>'Attempting to hack...<script>console.log("JSON: this should not be stopped.")</script>')) !!};
		document.write( '<p>'+myvar3.foo+'</p>' );
	</script>

	{!! esc_json( array('foo'=>'Attempting to hack...<script>console.log("JSON: this should be stopped.")</script>'), 'myjson' ) !!}

	<script type="application/javascript">
		var myvar4 = document.getElementById('myjson').textContent;
		var myvar5 = JSON.parse(_.unescape(myvar4));
		document.write( '<p>'+_.escape(myvar5.foo)+'</p>' );
	</script>

	<h3>User-Generated HTML</h3>

	<p>
		Avoid user-generated HTML whenever possible. When it's
		unavoidable, esc_html() will remove any script tags, as well
		as clean up unclosed tags, etc.
	</p>

	<pre>@{{ esc_html($userHtml) }}</pre>

	<h4>Examples (view source)</h4>

	<p>{!! "<b>Attempting to hack...</b><script>console.log('HTML: this should not be stopped.')</script>" !!}</p>
	<p>{!! esc_html("<b>Attempting to hack...</b><script>console.log('HTML: this should be stopped.')</script>") !!}</p>

@stop
