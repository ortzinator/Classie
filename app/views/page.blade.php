@extends('layout')

@section('content')
	<div class="page-header">
		<h1>{{{ $page->title }}}</h1>
	</div>
    {{ Markdown::string($page->content) }}
@stop