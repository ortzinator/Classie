@extends('layout')

@section('content')

<h3>Recent Listings:</h3>

@include('partials.postinglist', ['postings' => $recent])

{{ $recent->links() }}

@stop