@extends('layout')

@section('content')

<div class="page-header">
	<h1>{{ $user->username }}</h1>
</div>

<h2>Classifieds</h2>

@include('partials.postinglist', ['postings' => $posts])

@stop