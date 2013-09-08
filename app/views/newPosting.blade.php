@extends('layout')

@section('content')

<div class="page-header">
	<h1>Post a classified</h1>
</div>

{{ ($errors->any()) ? '<div>error!</div>' : '' }}
{{ Form::model(Input::old(), ['url' => 'do_post', 'class' => '']) }}

<div class="control-group{{ ($errors->has('title')) ? ' error' : '' }}">
	{{ Form::label('title', 'Title:') }}
	{{ Form::text('title', NULL, ['class' => 'span4']); }}
	{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
</div>

<div class="control-group{{ ($errors->has('category')) ? ' error' : '' }}">
	{{ Form::label('category', 'Category:') }}
	{{ Form::select('category', $categoryList, '', ['class' => 'span2']) }}
	{{ $errors->first('category', '<span class="help-inline">:message</span>') }}
</div>

<div class="control-group{{ ($errors->has('area')) ? ' error' : '' }}">
	{{ Form::label('area', 'Area:') }}
	{{ Form::text('area', NULL, ['class' => 'span2']) }}
	<span class="help-inline">(optional)</span>
	{{ $errors->first('area', '<span class="help-inline">:message</span>') }}
</div>

<div class="control-group{{ ($errors->has('detail')) ? ' error' : '' }}">
	{{ Form::label('detail', 'Detail:')}}
	{{ Form::textarea('detail', NULL, ['class' => 'span7']) }}
	{{ $errors->first('detail', '<span class="help-inline">:message</span>') }}
</div>

<div class="control-group{{ ($errors->has('days')) ? ' error' : '' }}">
	{{ Form::label('days', 'Days to keep:') }}
	{{ Form::text('days', NULL, ['class' => 'span4']) }}
	<span class="help-inline">1 - 60 days (optional)</span>
	{{ $errors->first('days', '<span class="help-inline">:message</span>') }}
</div>

<div class="controls">
	{{ Form::submit('Post', ['class' => 'btn btn-primary']) }}
</div>

{{ Form::close() }}

@stop