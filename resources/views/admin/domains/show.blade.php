@extends('admin.layout')

@section('content')

  <div class="row">
    <div class="small-12 columns">
      <div class="clearfix">
        <a href="{!! route('admin.domains.edit', $domain->id) !!}" class="button primary right">Edit</a>
        <h1>{{ $domain->name }}</h1>
      </div>
      <p>Redirect URL: {{ $domain->redirect_url }}</p>
      <p>Redirect Status Code: {{ $domain->status }}</p>
      <p>Active: {{ $domain->active ? 'Yes' : 'No' }}</p>
      <p>Hits: {{ $domain->hits }}</p>
      <h3>Top Referers</h3>
      <table>
        <thead>
          <tr>
            <th>Count</th>
            <th>Url</th>
          </tr>
        </thead>
        <tbody>
          @foreach($referers as $r)
          <tr>
            <td>{{ $r->count }}</td>
            <td>{{ $r->referer }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@stop
