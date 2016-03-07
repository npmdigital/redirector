@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="small-6 small-offset-3 columns">
      <div class="clearfix">
        <a href="{!! route('admin.domains.edit', $domain->id) !!}" class="button primary right">Edit</a>
        <h1>{!! $domain->name !!}</h1>
      </div>
      <p>Redirect URL: {!! $domain->redirect_url !!}</p>
      <p>Redirect Status Code: {!! $domain->redirect_url !!}</p>
      <p>Active: {!! $domain->redirect_url !!}</p>
    </div>
  </div>
