@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="small-6 small-offset-3 columns">
      <h1>New Domain</h1>
      {{ Form::open(['route' => 'admin.domains.store']) }}

          @include('admin.domains._form')

      {{ Form::close() }}
    </div>
  </div>

@stop
