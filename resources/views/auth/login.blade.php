@extends('layout')

@section('content')

<div class="row">
  <div class="small-12 medium-6 medium-offset-3 columns">
    <h3>NPM Redirector <small>Login</small></h3>
    @if (count($errors) > 0)
      <div class="callout alert">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form role="form" method="POST" action="{{ url('/auth/login') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <label for="username">Username</label>
      <input type="text" name="username" value="{{ old('username') }}">

      <label for="password">Password</label>
      <input type="password" name="password">

      <p><button type="submit" class="button primary expanded">Login</button></p>
    </form>
  </div>
</div>

@endsection
