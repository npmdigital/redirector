@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="small-6 small-offset-3 columns">
      <h1>New Domain</h1>
      {!! Form::model($domain, ['route' => ['admin.domains.update', $domain->id], 'method' => 'PATCH']) !!}

          @include('admin.domains._form')

      {!! Form::close() !!}
    </div>
  </div>

@stop
