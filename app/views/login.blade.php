@extends('layout')

@section('content')

{{ Form::open(array('url' => 'auth/login')) }}

@if($errors->any())
<?php dd($errors->all()) ?>
@endif

<fieldset>
	<legend>Log in</legend>
	@if ($errors->any())
		<div class="alert alert-error">Username or password incorrect.</div>
	@endif
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', '', array('required' => '')) }}
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', array('required' => '')) }}
	<div></div>
	{{ Form::button('Submit', array('class' => 'btn primary', 'type' => 'submit')) }}
</fieldset>

{{ Form::close() }}

@stop