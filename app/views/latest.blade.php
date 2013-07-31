@extends('layout')

@section('content')

@if(Sentry::check())
	<h1>{{{ Config::get('classie.site_title') }}}</h1>
	<h4>{{{ Config::get('classie.site_description_short') }}}</h4>
@else
<div id="welcome" class="hero-unit">
	<h1>{{{ Config::get('classie.site_title') }}}</h1>
	<p>{{{ Config::get('classie.site_description_long') }}}</p>
	<p>{{ link_to('about', 'Learn more »', array('class'=>'btn primary large')) }}</p>
</div>
@endif
<h3>Recent Listings:</h3>

<table class="table result table-striped">
	<tr><th>Title</th><th>Area</th><th>Category</th></tr>
	@foreach ($recent as $row)
		<tr>
			<td>{{ link_to_route('posting', $row->title, array($row->id)) }}</td>
			<td>{{{ $row->area }}}</td>
			<td>{{{ $row->category->name }}}</td>
		</tr>
	@endforeach
</table>

@stop