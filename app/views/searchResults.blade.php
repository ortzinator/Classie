@extends('layout')

@section('content')

<div class="page-header">
	<h2>Search Results</h2>
</div>

@include('partials.postinglist', ['postings' => $results])

{{ $results->links() }}
@stop