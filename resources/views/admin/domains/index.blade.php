@extends('admin.layout')

@section('content')

<div class="clearfix">
  <a href="{!! route('admin.domains.create') !!}" class="button primary right">+ Domain</a>
  <h1>Domains</h1>
</div>

<table class="stack">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Hits</th>
      <th>Redirect URL</th>
      <th>Redirect Status</th>
      <th>Active</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($domains as $i => $d)
      <tr>
        <td>{{ $i + 1 }}.</td>
        <td><a href="{!! route('admin.domains.show', $d->id) !!}">{{ $d->name }}</a></td>
        <td>{{ $d->hits }}</td>
        <td><span class="hide-for-large"><b>Redirect URL</b>: </span>{{ $d->redirect_url }}</td>
        <td><span class="hide-for-large"><b>Redirect Status Code</b>: </span>{!! $d->status !!}</td>
        <td><span class="hide-for-large"><b>Active</b>: </span>{{ $d->active ? 'Yes' : 'No' }}</td>
        <td><a href="{!! route('admin.domains.show', $d->id) !!}" class="button primary expanded"><i class="fi-magnifying-glass"></i></a></td>
        <td><a href="{!! route('admin.domains.edit', $d->id) !!}" class="button success expanded"><i class="fi-pencil"></i></a></td>
        <td>
            {!! Form::open(['route' => ['admin.domains.destroy', $d->id], 'method' => 'DELETE']) !!}
              <button type="submit" class="button alert expanded"><i class="fi-trash"></i></button>
            {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop
