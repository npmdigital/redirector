{!! Form::label('name', 'Domain Name') !!}
{!! Form::text('name', null, ['placeholder' => 'some-domain.org']) !!}

{!! Form::label('redirect_url', 'Redirect URL') !!}
{!! Form::text('redirect_url', null, ['placeholder' => 'http://some-other-domain.org']) !!}

{!! Form::label('status', 'Status') !!}
<small>Only use 301 if you REALLY know what you're doing.</small>
{!! Form::select('status', ['302' => '302', '301' => '301']) !!}

{{-- {!! Form::label('active', 'Active') !!}
{!! Form::checkbox('active', null, ['checked' => 'checked']) !!} --}}

{{-- <input type="checkbox" name="active" checked="checked"> --}}

<label for="active">Active?</label>
<div class="switch">
  <input class="switch-input" id="active" type="checkbox" name="active" checked>
  <label class="switch-paddle" for="active">
    <span class="show-for-sr">Active</span>
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>


<div class="clearfix">
  <div class="button-group right">
    <a href="{{ route('admin.domains.index') }}" class="button alert">Cancel</a>
    {!! Form::submit('Submit', ['class' => 'button primary']) !!}
  </div>
</div>
