@extends('layout')

@section('content')

<h2>Security</h2>

<ul>
<li>{!! link_to('security/xss', 'Cross-Site Scripting (XSS)') !!}</li>
<li>{!! link_to('security/sqli', 'SQL Injection (SQLI)') !!}</li>
<li>{!! link_to('security/csrf', 'Cross-Site Request Forgery (CSRF)') !!}</li>
</ul>

@stop
