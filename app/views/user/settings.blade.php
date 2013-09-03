@extends('layout')

@section('content')

<div class="page-header">
	<h1>Post a classified</h1>
</div>

{{ ($errors->any()) ? '<div>error!</div>' : '' }}
{{ Form::model($user, ['url' => 'saveSettings', 'class' => '']) }}

<div class="control-group{{ ($errors->has('username')) ? ' error' : '' }}">
	{{ Form::label('username', 'Username:') }}
	<span class="span4 uneditable-input">{{ $user->username }}</span>
</div>

<div class="control-group{{ ($errors->has('name')) ? ' error' : '' }}">
	{{ Form::label('name', 'Name:') }}
	{{ Form::text('name', NULL, ['class' => 'span4']); }}
	{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
</div>

<div class="controls">
	{{ Form::submit('Submit changes', ['class' => 'btn btn-primary']) }}
</div>

{{ Form::close() }}

@stop