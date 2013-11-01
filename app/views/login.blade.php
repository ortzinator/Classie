@extends('layout')

@section('content')

{{ Form::open(['url' => 'auth/login']) }}

<fieldset>
	<legend>Log in</legend>
	@if ($errors->any())
		<div class="alert alert-error">Username or password incorrect.</div>
	@endif
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', '', ['required' => '']) }}
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', ['required' => '']) }}
	<label class="checkbox" for="remember">
		{{ Form::checkbox('remember', 'remember') }} Remember
	</label>
	<div></div>
	{{ Form::button('Submit', ['class' => 'btn primary', 'type' => 'submit']) }}
</fieldset>

{{ Form::close() }}

@stop