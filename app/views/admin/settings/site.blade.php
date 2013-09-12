@extends('admin.layout')

@section('content')

{{ Form::model($settings, array('action' => 'AdminSettingsController@postSite', 'class' => 'form-horizontal')) }}
<fieldset>
    <legend>Settings</legend>
	<div class="control-group">
	{{ Form::label('site_title', 'Title:', ['class' => 'control-label']) }}
	<div class="controls">
	{{ Form::text('site_title', NULL, ['class' => 'span5']) }}
	</div></div>

	<div class="control-group">
	{{ Form::label('site_description_long', 'Description:', ['class' => 'control-label']) }}
	<div class="controls">
	{{ Form::textarea('site_description_long', NULL, ['class' => 'span5']) }}
	</div></div>

	<div class="control-group">
	{{ Form::label('site_description_short', 'Short description:', ['class' => 'control-label']) }}
	<div class="controls">
	{{ Form::text('site_description_short', NULL, ['class' => 'span5']) }}
	</div></div>

	<div class="controls">
	{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
	</div>
</fieldset>

{{ Form::close() }}

@stop