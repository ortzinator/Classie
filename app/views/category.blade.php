@extends('layout')

@section('content')

<h2>{{{ $category->name }}}</h2>

@if(count($category->postings) > 0)
<table class="table result table-striped">
	<tr><th>Title</th><th>Area</th></tr>
	@foreach ($category->postings as $row)
		<tr>
			<td>{{ link_to_route('posting', $row->title, array($row->id)) }}</td>
			<td>{{{ $row->area }}}</td>
		</tr>
	@endforeach
</table>
@else
<div class="alert alert-info">This category has no active classifieds.</div>
@endif

@stop