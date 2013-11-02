@extends('layout')

@section('content')

<h2>{{{ $category->name }}}</h2>

@include('partials.postinglist', ['postings' => $postings])

{{ $postings->links() }}

@stop