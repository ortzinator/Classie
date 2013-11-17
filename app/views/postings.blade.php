@extends('layout')

@section('content')

@include('partials.postinglist', ['postings' => $postings])

{{ $postings->links() }}

@stop