@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Post</h1>
        <h2>{{ $post->title }}</h2>
        <div>{!! nl2br(e($post->body)) !!}</div>
    </div>
@endsection