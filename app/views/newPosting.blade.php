@extends('layout')

@section('content')

<div class="page-header">
	<h1>Post a classified</h1>
</div>

{{ ($errors->any()) ? '<div>error!</div>' : '' }}
{{ Form::model(Input::old(), array('url' => 'do_post', 'class' => '')) }}
	<div class="control-group{{ ($errors->has('title')) ? ' error' : '' }}">
		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title', '', array('class' => 'span4')); }}
		{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
	</div>
	
	<div class="control-group{{ ($errors->has('category')) ? ' error' : '' }}">
		{{ Form::label('category', 'Category:') }}
		{{ Form::select('category', Category::lists('name', 'id'), '', array('class' => 'span2')) }}
		{{ $errors->first('category', '<span class="help-inline">:message</span>') }}
	</div>
	
	<div class="control-group{{ ($errors->has('area')) ? ' error' : '' }}">
		{{ Form::label('area', 'Area:') }}
		{{ Form::text('area', '', array('class' => 'span2')) }}
		<span class="help-inline">(optional)</span>
		{{ $errors->first('area', '<span class="help-inline">:message</span>') }}
	</div>
	
	<div class="control-group{{ ($errors->has('detail')) ? ' error' : '' }}">
		{{ Form::label('detail', 'Detail:')}}
		{{ Form::textarea('detail', '', array('class' => 'span7')) }}
		{{ $errors->first('detail', '<span class="help-inline">:message</span>') }}
	</div>
	
	<div class="control-group{{ ($errors->has('days')) ? ' error' : '' }}">
		{{ Form::label('days', 'Days to keep:') }}
		{{ Form::text('days', '', array('class' => 'span4')) }}
		<span class="help-inline">1 - 60 days (optional)</span>
		{{ $errors->first('days', '<span class="help-inline">:message</span>') }}
	</div>

	<div class="controls">
		{{ Form::submit('Post', array('class' => 'btn btn-primary')) }}
	</div>
{{ Form::close() }}

@stop