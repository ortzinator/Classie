@extends('layout')

@section('content')

<div class="page-header">
	<h1>Post a classified</h1>
</div>
<?php //print validation_errors(); ?>
{{ Form::model(Input::old(), array('url' => 'doPost', 'class' => 'body')) }}
<div class="clearfix">
	{{ Form::label('title', 'Title:') }}
	<div class="input">{{ Form::text('title', '', array('class' => 'span7')); }}</div>
</div>
<div class="clearfix">
	{{ Form::label('category', 'Category:') }}
	<div class="input">
		{{ Form::select('category', Category::lists('name', 'id'), '', array('class' => 'span4')) }}
	</div>
</div>
<div class="clearfix">
	{{ Form::label('area', 'Area:') }}
	<div class="input">
		{{ Form::text('area', '', array('class' => 'span7')) }}
		<span class="help-inline">(optional)</span>
	</div>
</div>
<div class="clearfix">
	{{ Form::label('detail', 'Detail:')}}
	<div class="input">
		{{ Form::textarea('detail', '', array('class' => 'span7')) }}
	</div>
</div>
<div class="clearfix">
	{{ Form::label('days', 'Days to keep:') }}
	<div class="input">
		{{ Form::text('days', '', array('class' => 'span4')) }}
		<span class="help-inline">1 - 60 days (optional)</span>
	</div>
</div>
<div class="actions">
	{{ Form::submit('Post', array('class' => 'btn primary')) }}
</div>
{{ Form::close() }}

@stop