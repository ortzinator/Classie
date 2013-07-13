@extends('layout')

@section('content')

<div class="page-header">
	<h1>{{ $user->username }}</h1>
</div>

<h2>Classifieds</h2>

@if(isset($posts) && count($posts) > 0)
<table class="table result table-striped">
	<tr><th>Title</th><th>Area</th><th>Category</th></tr>
	@foreach ($posts as $row)
		<tr>
			<td>{{ link_to_route('posting', $row->title, array($row->id)) }}</td>
			<td>{{{ $row->area }}}</td>
			<td>{{{ $row->category->name }}}</td>
		</tr>
	@endforeach
</table>
@else
<div class="alert alert-info">This user has no active classifieds.</div>
@endif

@stop