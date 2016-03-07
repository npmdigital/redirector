{{ Form::label('name', 'Domain Name') }}
{{ Form::text('name') }}

{{ Form::label('redirect_url', 'Redirect URL') }}
{{ Form::text('redirect_url') }}

{{ Form::label('status', 'Status') }}
{{ Form::select('status', ['302' => '302', '301' => '301']) }}

{{ Form::label('active', 'Active') }}
{{ Form::checkbox('active') }}

<div class="clearfix">
  {{ Form::submit('Submit', ['class' => 'button primary right']) }}
</div>
