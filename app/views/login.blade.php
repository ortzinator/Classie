@extends('layout')

@section('content')

<div class="row">
	<div class="span12">
		{{ Form::open(['route' => 'auth.store', 'class' => 'form-horizontal']) }}
		<fieldset>
			<div id="legend">
				<legend class="">Login</legend>
			</div>
			<div class="control-group">
				{{ Form::label('email', 'Email', ['class' => 'control-label']) }}
				<div class="controls">
					{{ Form::email('email', '', ['required' => '']) }}
				</div>
			</div>
			<div class="control-group">
				{{ Form::label('password', 'Password', ['class' => 'control-label']) }}
				<div class="controls">
					{{ Form::password('password', ['required' => '']) }}
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox" for="remember" class="control-label">
						{{ Form::checkbox('remember', 'remember') }} Remember
					</label>
					<button class="btn btn-success">Login</button>
				</div>
			</div>
		</fieldset>
		{{ Form::close() }}
	</div>
</div>

@stop