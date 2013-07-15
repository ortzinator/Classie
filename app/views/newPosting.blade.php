@extends('layout')

@section('content')

<div class="page-header">
	<h1>Post a classified</h1>
</div>

<?php //print validation_errors(); ?>
{{ Form::model(Input::old(), array('url' => 'doPost', 'class' => '')) }}
	{{ Form::label('title', 'Title:') }}
	{{ Form::text('title', '', array('class' => 'span4')); }}
	
	{{ Form::label('category', 'Category:') }}
	{{ Form::select('category', Category::lists('name', 'id'), '', array('class' => 'span2')) }}
	
	{{ Form::label('area', 'Area:') }}
	{{ Form::text('area', '', array('class' => 'span2')) }}
	<span class="help-inline">(optional)</span>
	
	{{ Form::label('detail', 'Detail:')}}
	{{ Form::textarea('detail', '', array('class' => 'span7')) }}
	
	{{ Form::label('days', 'Days to keep:') }}
	{{ Form::text('days', '', array('class' => 'span4')) }}
	<span class="help-inline">1 - 60 days (optional)</span>
<div class="controls">
	{{ Form::submit('Post', array('class' => 'btn btn-primary')) }}
</div>
{{ Form::close() }}

@stop