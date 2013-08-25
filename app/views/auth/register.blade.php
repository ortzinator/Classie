@extends('layout')

@section('content')

{{ Form::open(array('url' => 'auth/register', 'autocomplete' => 'off')) }}

<fieldset>
	<legend>Register</legend>
	@if ($errors->any())
		<div class="alert alert-error">An error occurred</div>
	@endif
	<div class="control-group{{ ($errors->has('email')) ? ' error' : '' }}">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', '') }}
		{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
	</div>

	<div class="control-group{{ ($errors->has('username')) ? ' error' : '' }}">
		{{ Form::label('username', 'Username') }}
		{{ Form::text('username', '') }}
		{{ $errors->first('username', '<span class="help-inline">:message</span>') }}
	</div>
	
	<div class="control-group{{ ($errors->has('password')) ? ' error' : '' }}">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
	</div>

	<div class="control-group{{ ($errors->has('password_confirmation')) ? ' error' : '' }}">
		{{ Form::label('password_confirmation', 'Confirm Password') }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
	</div>
	<div>
		{{ Form::button('Register', array('class' => 'btn primary', 'type' => 'submit')) }}
	</div>
</fieldset>

{{ Form::close() }}

@stop